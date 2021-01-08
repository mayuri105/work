<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payumoney extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('package/package_models','package');
		// /!is_login() ? redirect('index') : '';
	
	}

	public function index()
	{
		$data = array();
		$theme = $this->session->userdata('front_theme');
		$id = $this->session->userdata('buypackage');
		$order_info= $this->package->getBuyPackData($id);
        $customer = getActiveCustomerInfo();

		$data['merchant'] = $this->setting->get('payu_key');

		/////////////////////////////////////Start Payu Vital  Information /////////////////////////////////

		if ($this->setting->get('payu_test')) {
			$data['action'] = 'https://test.payu.in/_payment.php';
		} else {
			$data['action'] = 'https://secure.payu.in/_payment.php';
		}

		$txnid = $this->session->userdata('buypackage');

		$data['key'] = $this->setting->get('payu_key');
		$data['salt'] = $this->setting->get('payu_salt');
		$data['txnid'] = $txnid;

		$data['amount'] = (float) $order_info->totalamt;

		$data['productinfo'] = $order_info->package_name;
		
		$data['firstname'] = $customer->first_name;


		$data['email'] = $customer->email;
		$data['phone'] = $customer->phone;
		$data['pg'] = 'CC';
		$data['surl'] = site_url('payumoney/callback'); 
		$data['furl'] =site_url('payumoney/callback');
		$data['curl'] = site_url('payumoney/cancel');

		$data['service_provider'] = 'payu_paisa';
		$data['udf2'] = $txnid;
		

		$key = $this->setting->get('payu_key');

		$amount = $data['amount'];
		$productInfo = $data['productinfo'];
		$firstname = $customer->first_name;
		$email = $customer->email;
		$salt = $this->setting->get('payu_salt');
		$udf2 = $data['udf2'];
		$hash_str = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '||' . $udf2 . '|||||||||' . $salt;
		$Hash = hash('sha512', $hash_str);

		$data['hash'] = $Hash;
		/////////////////////////////////////End Payu Vital  Information /////////////////////////////////

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/payu/payu')) {
			$this->load->view('themes/' . $theme . '/template/payu/payu', $data);
		} else {
			$this->load->view('themes/default/template/payu/payu', $data);
		}

	}

	public function callback(){
		if ( $this->input->post('key') && ($this->setting->get('payu_key') == $this->input->post('key'))) {

			$id = $this->input->post('udf2');
			$order_info= $this->package->getBuyPackData($id);

			$key = $this->input->post('key');
			$amount = $this->input->post('amount');
			$productInfo = $this->input->post('productinfo');
			$firstname = $this->input->post('firstname');
			$email = $this->input->post('email');
			$salt = $this->setting->get('payu_salt');

			$txnid = $this->input->post('txnid');

			$udf2 = $this->input->post('udf2');

			$keyString = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '||' . $udf2 . '||||||||';
			$keyArray = explode("|", $keyString);
			$reverseKeyArray = array_reverse($keyArray);
			$reverseKeyString = implode("|", $reverseKeyArray);



			if ($this->input->post('status') && 'success' == $this->input->post('status')) {
				$saltString = $salt . '|' . $this->input->post('status') . '|' . $reverseKeyString;
				$sentHashString = strtolower(hash('sha512', $saltString));
				$responseHashString = $this->input->post('hash');

				$order_id = $this->input->post('udf2');
				
				if ($sentHashString == $this->input->post('hash')) {
					//payment success
					 $data = array(
			            'payment_done'=>1,
			        );
			        $this->package->updateBuyPack($data);
			        redirect('package/success');

				} else {
					//Transaction will be pending
					redirect('package/payment_pending');
				}

			} else {
				redirect('package/payment_failure');
					
			}
		}
		//print_r($this->input->post('key'));
		redirect('package/payment_failure');
	}


	

}

/* End of file Payu.php */
/* Location: ./application/controllers/Payu.php */