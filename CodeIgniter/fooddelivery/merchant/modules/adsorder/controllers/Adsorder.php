<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adsorder extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('adsorder_model', 'adsorder');
	}

	public function index()
	{
		if ($this->session->userdata('addpackge_id')=='') {
			redirect('merchant/store','refresh');
		}
		$data = array();


		$data['store'] = $this->adsorder->getStoreData();
		$data['package'] = $this->adsorder->getPackageData();


		$stripe_test_mode = $this->setting->get('stripe_test_mode');  
		$data['stripe_enable'] = $this->setting->get('stripe_enable');
		if($stripe_test_mode=='true'){
        	$data['stripe_key_public'] = $this->setting->get('stripe_key_test_public');
    	}else{
    		$data['stripe_key_public'] = $this->setting->get('stripe_key_live_public');  
    	}


		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/adsorder/index')) {
			$this->load->view('themes/' . $theme . '/template/adsorder/index', $data);
		} else {
			$this->load->view('themes/default/template/adsorder/index', $data);
		}
	}


	public function addadsOrder()
	{

		$store = $this->adsorder->getStoreData();
		$package = $this->adsorder->getPackageData();
		if (post('stripetoken')) {
				$data = array(
					'store_id'=>$store->store_id,
					'store_name'=>$store->store_name,
					'package_id'=>$package->asp_id,
					'package_name'=>$package->package_name,
					'package_price'=>$package->package_price,
					'package_periods'=>$package->package_periods,
					'payment_type'=>'credit',
					'payment_done'=>'0',
					'merchant_id'=>$store->merchant_id,
					'added_date'=>date('Y-m-d')
				);
				$ret = $this->adsorder->insert($data);
		}else{
			$data = array(
				'store_id'=>$store->store_id,
				'store_name'=>$store->store_name,
				'package_id'=>$package->asp_id,
				'package_name'=>$package->package_name,
				'package_price'=>$package->package_price,
				'package_periods'=>$package->package_periods,
				'payment_type'=>'paypal',
				'payment_done'=>'0',
				'merchant_id'=>$store->merchant_id,
				'added_date'=>date('Y-m-d')
			);
			$ret = $this->adsorder->insert($data);
		}		
		if ($ret) {

			if (post('stripetoken')) {
				$this->session->set_userdata(array(
					'stripeToken'=>post('stripetoken'),
					'ao_id'=>$ret
					));
				redirect('stripepayment');
			}else{
				$this->session->set_userdata(array(
					'ao_id'=>$ret
					));
				redirect('paypal');
			}
		}else{
			redirect('adsorder','refresh');
		}

	}

	public function error(){
		
		$data = array();
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/adsorder/error')) {
			$this->load->view('themes/' . $theme . '/template/adsorder/error', $data);
		} else {
			$this->load->view('themes/default/template/adsorder/error', $data);
		}
	}

	public function success(){

		$data = array();	
		$unsetSessiondata = array('store_id','ao_id','addpackge_id');
        $this->session->unset_userdata($unsetSessiondata);  
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/adsorder/success')) {
			$this->load->view('themes/' . $theme . '/template/adsorder/success', $data);
		} else {
			$this->load->view('themes/default/template/adsorder/success', $data);
		}
	}
}

/* End of file Adsorder.php */
/* Location: ./application/controllers/Adsorder.php */