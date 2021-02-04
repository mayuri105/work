<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_model extends CI_Model {

	
	public function __construct() {
		parent::__construct();
		$this->load->helper('text');
		
	}

	public function cleanReturn($data) {
		$data = explode('&', $data);

		$arr = array();

		foreach ($data as $k => $v) {
			$tmp = explode('=', $v);
			$arr[$tmp[0]] = urldecode($tmp[1]);
		}

		return $arr;
	}

	public function call($data){

		$is_sandbox = $this->setting->get('paypal_test');

		if ($is_sandbox) {
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
		} else {
			$api_endpoint = 'https://api-3t.paypal.com/nvp';
		}

		$settings = array(
			'USER' => $this->setting->get('paypal_username'),
			'PWD' => $this->setting->get('paypal_password'),
			'SIGNATURE' => $this->setting->get('paypal_signature'),
			'VERSION' => '65.2',
			'BUTTONSOURCE' => $this->setting->get('company_name'),
		);

		$defaults = array(
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $api_endpoint,
			CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
			CURLOPT_FRESH_CONNECT => 1,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FORBID_REUSE => 1,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_POSTFIELDS => http_build_query(array_merge($data, $settings), '', "&")
		);

		$ch = curl_init();

		curl_setopt_array($ch, $defaults);
		
		if (!$result = curl_exec($ch)) {
			$this->session->set_flashdata('curl_error', array('error' => curl_error($ch), 'errno' => curl_errno($ch)));
		}

		curl_close($ch);
		
		return $this->cleanReturn($result);
	}
	 public function createToken($len = 32) {
		$base = 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
		$max = strlen($base) - 1;
		$activatecode = '';
		mt_srand((double) microtime() * 1000000);
		while (strlen($activatecode) < $len + 1)
			$activatecode.=$base{mt_rand(0, $max)};

		return $activatecode;
	}

	public function isMobile() {
		/*
		 * This will check the user agent and "try" to match if it is a mobile device
		 */
		if (preg_match("/Mobile|Android|BlackBerry|iPhone|Windows Phone/", $_SERVER['HTTP_USER_AGENT'])) {
			return true;
		} else {
			return false;
		}
	}

	public function recurringCancel($ref) {

		$data = array(
			'METHOD' => 'ManageRecurringPaymentsProfileStatus',
			'PROFILEID' => $ref,
			'ACTION' => 'Cancel'
		);

		return $this->call($data);
	}

	public function paymentRequestInfo() {

		$order_id = $this->session->userdata('order_id');
		$totalamt = $this->getTotalAmt();
		$data['PAYMENTREQUEST_0_SHIPPINGAMT'] = '';
		$data['PAYMENTREQUEST_0_CURRENCYCODE'] = $this->setting->get('currency');
		$data['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';

		$data['PAYMENTREQUEST_0_ITEMAMT'] = number_format($totalamt, 2, '.', '');
		$data['PAYMENTREQUEST_0_AMT'] = number_format($totalamt, 2, '.', '');
		
		$data['L_PAYMENTREQUEST_0_NUMBER0'] = 1;
		$data['L_PAYMENTREQUEST_0_AMT0'] = number_format($totalamt, 2, '.', ''); //currency conversion
		$data['L_PAYMENTREQUEST_0_QTY0'] = 1;
		$data['L_PAYMENTREQUEST_0_ITEMURL0'] = base_url();

		return $data;
	}

	public function getTotalAmt(){

		$order_id = $this->session->userdata('order_id'); 
        $productdata = $this->getOrderData($order_id);
        $totalamt=0;
        foreach ($productdata as $pd) {
            $priceOfProduct = $pd->priceNew + $pd->product_price;
            $price = $pd->pro_quantity * $priceOfProduct;
            $totalamt = $totalamt +$price;
            $tipPer =$pd->tip_amount; 
        }
        $tip = ($totalamt * $tipPer )/100;
        $totalamt = $totalamt + $tip;

        return $totalamt;
	}
	 public function getOrderData($order_id){
        
        $this->db->select('orders.*,order_item.*,sum(order_item_option.price) as priceNew', FALSE);
        $this->db->group_by('order_item.oi_id');
        $this->db->where('orders.o_id',$order_id);
        $this->db->join('order_item', 'order_item.o_id  = orders.o_id');
        $this->db->join('order_item_option', 'order_item_option.order_item_id = order_item.oi_id', 'left');
        
        
        $query= $this->db->get('orders');

        
        return $query->result();
    }
}

/* End of file Paypal_model.php */
/* Location: ./application/models/Paypal_model.php */ ?>