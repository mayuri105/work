<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripepayment extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('adsorder/adsorder_model','adsorder');
		$this->load->library('init');
		$stripe_test_mode = $this->setting->get('stripe_test_mode');  
       	$stripe_verify_ssl = $this->setting->get('stripe_verify_ssl');  
        $stripe_key_test_public = $this->setting->get('stripe_key_test_public');  
       	$stripe_key_test_secret = $this->setting->get('stripe_key_test_secret');  
        $stripe_key_live_public = $this->setting->get('stripe_key_live_public');  
        $stripe_key_live_secret = $this->setting->get('stripe_key_live_secret');  
        if($stripe_test_mode=='true'){
        	\Stripe\Stripe::setApiKey($stripe_key_test_secret);
    	}else{
    		\Stripe\Stripe::setApiKey($stripe_key_live_secret);
    	}
	}

	public function index()
	{
		
		$merchant = $this->adsorder->getActiveMerchantInfo();
		$stripe_currency_code = $this->setting->get('stripe_currency_code');
		$token = $this->session->userdata('stripeToken');
		$package = $this->adsorder->getPackageData();

		$amount = $package->package_price *100;// amount in cents so multiply by 100

		if( !$merchant->stripe_cust_id ) {
 
			// create a new customer if our current user doesn't have one
			$Retmerchant = \Stripe\Customer::create(array(
					'card' => $token,
					'email' =>$merchant->username
				)
			);
		 
			$merchant_id = $Retmerchant->id;
		 	$dataFcustUpdate = array(
		 		'stripe_cust_id'=>$merchant_id
		 	);
		 	$where = array('m_id'=>$merchant->m_id);
		 	$update = $this->adsorder->updateMerchant($dataFcustUpdate,$where);

		 	if($update){
		 		$charge = \Stripe\Charge::create(
					array(
					'amount' => $amount, // amount in cents
					'currency' => $stripe_currency_code,
					'customer' => $merchant_id
					)
				);
		 		if($charge->paid){
		 			
		 			$this->session->set_flashdata('msg',$charge->status);
		 			redirect('stripepayment/success');
		 		}else{
		 			$this->session->set_flashdata('msg',$charge->status);
		 			redirect('adsorder/error');
		 		}
		 	}else{
		 		$this->session->set_flashdata('msg','Error in transaction');
		 		redirect('adsorder/error');
		 	}
		}


		if(!is_null($merchant->stripe_cust_id)){
			

			$merchantIn = \Stripe\Customer::retrieve($merchant->stripe_cust_id);
			$merchantIn->sources->create(array("source" => $token ));


			$charge = \Stripe\Charge::create(
				array(
				'amount' =>$amount, // amount in cents
				'currency' => $stripe_currency_code,
				'customer' => $merchant->stripe_cust_id
				)
			);
			if($charge->paid){
				
				$this->session->set_flashdata('msg',$charge->status);
	 			redirect('stripepayment/success');
	 		}else{
	 			$this->session->set_flashdata('msg',$charge->status);
	 			redirect('adsorder/error');
	 		}

		}else{
			$this->session->set_flashdata('msg','Error in transaction');	
			redirect('adsorder/error');
		}
		


	}
	
	function success(){
		// main order update 
		$data = array(
			'payment_done' => '1',

		 );
		$ao_id = $this->session->ao_id;
		$where =array('ao_id'=>$ao_id);

		$update = $this->adsorder->updateAdsOrder($data,$where);
		if ($update) {
			redirect('adsorder/success');
		}else{
			redirect('adsorder/error');
		}
        
	}


    
}

/* End of file Stripe.php */
/* Location: ./application/controllers/Stripe.php */