<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('paypal_model','paypal');
		$this->load->model('adsorder/adsorder_model', 'adsorder');
	}

	public function index()
	{
			$is_sandbox = $this->setting->get('paypal_test');

            $package = $this->adsorder->getPackageData();
            $amount = $package->package_price;

            $data = array(
				'METHOD' => 'SetExpressCheckout',
				'RETURNURL' => site_url('paypal/expressComplete'),
				'CANCELURL' => site_url('adsorder'),
				'REQCONFIRMSHIPPING' => 0,
				'NOSHIPPING' => 1,
				'LOCALECODE' => 'EN',
				'LANDINGPAGE'=> 'Login',
				'ALLOWNOTE' => 1,
				'PAYMENTREQUEST_0_SHIPPINGAMT' => '',
				'PAYMENTREQUEST_0_CURRENCYCODE' => $this->setting->get('currency'),
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale' ,
				'PAYMENTREQUEST_0_ITEMAMT'  =>  number_format($amount, 2, '.', ''),
				'PAYMENTREQUEST_0_AMT'  =>  number_format($amount, 2, '.', ''),

			);

            $i= 0;
            
            $data['L_PAYMENTREQUEST_0_NAME0'] = $package->package_name;
            $data['L_PAYMENTREQUEST_0_AMT0']  = number_format($package->package_price, 2, '.', '');
            $data['L_PAYMENTREQUEST_0_QTY0']  = '1';
            $data['L_PAYMENTREQUEST_0_ITEMURL0'] = site_url('adsorder');  
            $result = $this->paypal->call($data);
            /**
			 * If a failed PayPal setup happens, handle it.
			 */
			if(!isset($result['TOKEN'])) {
				$this->session->set_flashdata('msg', 'Error: Invalid Token!');
				$this->session->set_flashdata('xml', $result);
				redirect('paypal/error');
			}

			$paypal['TOKEN'] = $result['TOKEN'];

			$this->session->set_userdata('paypal',$paypal);

			if($is_sandbox){
				redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $result['TOKEN']);
			}else{
				redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $result['TOKEN']);                    
			}


	}
	public function expressComplete() {

        $is_sandbox = $this->setting->get('paypal_test');

        $paypal = $this->session->userdata('paypal');
        
        $data = array(
            'METHOD' => 'GetExpressCheckoutDetails',
            'TOKEN' => $paypal['TOKEN'],
        );
        
        $result = $this->paypal->call($data);            

        $paypal['payerid']   = $result['PAYERID'];
        $paypal['result']    = $result;
        $this->session->set_userdata('paypal', $paypal);

        

        if(isset($result['PAYMENTREQUEST_0_NOTETEXT'])) {
            $this->session->set_userdata('comment', $result['PAYMENTREQUEST_0_NOTETEXT']);
        }

        $paypal_data = array(
            'TOKEN' => $paypal['TOKEN'],
            'PAYERID' => $paypal['payerid'],
            'METHOD' => 'DoExpressCheckoutPayment',
            'PAYMENTREQUEST_0_NOTIFYURL' => '',//ipn url
            'RETURNFMFDETAILS' => 1,
        );

        $paypal_data = array_merge($paypal_data, $this->paypal->paymentRequestInfo());

        $result = $this->paypal->call($paypal_data);

        
        if($result['ACK'] == 'Success') {

            
            //success redirect 
            $this->session->set_flashdata('success','paypal_success_msg');
           
            
            //add transaction to paypal transaction table 
            $paypal_transaction_data = array(
                'customer_id' => $this->session->userdata('m_id'),
                'order_id' =>  $this->session->userdata('ao_id'),
                'transaction_id' => $result['PAYMENTINFO_0_TRANSACTIONID'],
                'parent_transaction_id' => '',
                'note' => '',
                'msgsubid' => '',
                'receipt_id' => (isset($result['PAYMENTINFO_0_RECEIPTID']) ? $result['PAYMENTINFO_0_RECEIPTID'] : ''),
                'payment_type' => $result['PAYMENTINFO_0_PAYMENTTYPE'],
                'payment_status' => $result['PAYMENTINFO_0_PAYMENTSTATUS'],
                'pending_reason' => $result['PAYMENTINFO_0_PENDINGREASON'],
                'transaction_entity' => 'Sale',
                'amount' => $result['PAYMENTINFO_0_AMT'],
                'debug_data' => json_encode($result),
            );
            $this->db->insert('paypal_transaction_history', $paypal_transaction_data);            

            redirect('paypal/success/');
            

        } else {
            if ($result['L_ERRORCODE0'] == '10486') {
                if (isset($this->session->userdata['paypal_redirect_count'])) {

                    if ($this->session->userdata['paypal_redirect_count'] == 2) {
                            $this->session->set_userdata('paypal_redirect_count', 0);
                            $this->session->set_flashdata('msg','Error: too many failure');

                            redirect('paypal/error');

                    } else {
                            $this->session->userdata['paypal_redirect_count']++;
                    }
                } else {
                    $this->session->userdata['paypal_redirect_count'] = 1;
                }

                if ($is_sandbox) {
                    $this->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->session->userdata['paypal']['token']);
                } else {
                    $this->redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->session->userdata['paypal']['token']);
                }
            }

            $this->session->set_flashdata('msg',$result['L_LONGMESSAGE0']);

            redirect('paypal/error');
        }
    } 

     public function error(){

        $data['msg'] = $this->session->flashdata('msg');
        $data['xml'] = $this->session->flashdata('xml');
       	print_r($data);
       	//redirect('adsorder/error');
    }

    public function success(){
        $data = array(
			'payment_done' => '1',

		 );
		$ao_id = $this->session->ao_id;
		$where =array('ao_id'=>$ao_id);

		$update = $this->adsorder->updateAdsOrder($data,$where);
		if ($update) {
			redirect('adsorder/success');
		}else{
			//redirect('adsorder/error');
		}
    }
}

/* End of file Paypal.php */
/* Location: ./application/controllers/Paypal.php */