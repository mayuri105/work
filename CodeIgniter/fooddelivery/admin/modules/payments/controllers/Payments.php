<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data = array();
        $theme = $this->session->userdata('admin_theme');

         // paypal setting
        $data['paypal_enable'] = $this->setting->get('paypal_enable');  
        
        $data['paypal_test'] = $this->setting->get('paypal_test');  
       	$data['paypal_signature'] = $this->setting->get('paypal_signature');  
        $data['paypal_username'] = $this->setting->get('paypal_username');  
       	$data['paypal_password'] = $this->setting->get('paypal_password');  
        $data['currency'] = $this->setting->get('currency');  
       	$data['paypal_threshold_value'] = $this->setting->get('paypal_threshold_value');  
       
       	$data['stripe_enable'] = $this->setting->get('stripe_enable');  
        $data['stripe_test_mode'] = $this->setting->get('stripe_test_mode');  
       	$data['stripe_verify_ssl'] = $this->setting->get('stripe_verify_ssl');  
        $data['stripe_key_test_public'] = $this->setting->get('stripe_key_test_public');  
       	$data['stripe_key_test_secret'] = $this->setting->get('stripe_key_test_secret');  
        $data['stripe_key_live_public'] = $this->setting->get('stripe_key_live_public');  
        $data['stripe_key_live_secret'] = $this->setting->get('stripe_key_live_secret');  
        $data['stripe_currency_code'] = $this->setting->get('stripe_currency_code');
        $data['stripe_threshold_value'] = $this->setting->get('stripe_threshold_value');  
       
        $data['cod_enable'] = $this->setting->get('cod_enable');  
        $data['cash_threshold_value'] = $this->setting->get('cash_threshold_value');  
        
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/payments/index')) {
			$this->load->view('themes/' . $theme . '/template/payments/index', $data);
		} else {
			$this->load->view('themes/default/template/payments/index', $data);
			
		}
	}
	function savepaypalsetting(){
		if(checkModification()){
			$this->setting->update('paypal_test',$this->input->post('paypal_test'));
			$this->setting->update('paypal_signature',$this->input->post('paypal_signature'));
			$this->setting->update('paypal_username',$this->input->post('paypal_username'));
			$this->setting->update('paypal_password',$this->input->post('paypal_password'));
			$this->setting->update('currency',$this->input->post('currency')); 
			$this->setting->update('paypal_enable',$this->input->post('paypal_enable'));
			$this->setting->update('paypal_threshold_value',$this->input->post('paypal_threshold_value'));   
			$this->session->set_flashdata('success','Updated Successfully');
		   	redirect('payments');  
	   	}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('payments');
	    }   

	}
	function savestripesetting(){
		if(checkModification()){
		$this->setting->update('stripe_test_mode',$this->input->post('stripe_test_mode'));
		$this->setting->update('stripe_verify_ssl',$this->input->post('stripe_verify_ssl'));
		$this->setting->update('stripe_key_test_public',$this->input->post('stripe_key_test_public'));
		$this->setting->update('stripe_key_test_secret',$this->input->post('stripe_key_test_secret'));
		$this->setting->update('stripe_key_live_public',$this->input->post('stripe_key_live_public'));  
		$this->setting->update('stripe_key_live_secret',$this->input->post('stripe_key_live_secret')); 
		$this->setting->update('stripe_currency_code',$this->input->post('stripe_currency_code'));   
		$this->setting->update('stripe_enable',$this->input->post('stripe_enable'));  
		$this->setting->update('stripe_threshold_value',$this->input->post('stripe_threshold_value'));  
		$this->session->set_flashdata('success','Updated Successfully');
	   	redirect('payments'); 
	   	}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('payments');
	    } 
	}
	function savecod(){
		if(checkModification()){
		$this->setting->update('cod_enable',$this->input->post('cod_enable'));
		$this->setting->update('cash_threshold_value',$this->input->post('cash_threshold_value'));  
		$this->session->set_flashdata('success','Updated Successfully');
	   	redirect('payments');
	   	}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('payments');
	    }  
	}
}

/* End of file payments.php */
/* Location: ./application/controllers/payments.php */