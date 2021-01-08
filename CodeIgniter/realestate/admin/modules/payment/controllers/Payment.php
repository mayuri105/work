<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$data = array();
        $theme = $this->session->userdata('admin_theme');

         // paypal setting
       
        $data['payu_enable'] = $this->setting->get('payu_enable');  
		$data['payu_key'] = $this->setting->get('payu_key');  
      	$data['payu_test'] = $this->setting->get('payu_test');  
      	$data['payu_salt'] = $this->setting->get('payu_salt');  
      	        	

		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/payment/index')) {
			$this->load->view('themes/' . $theme . '/template/payment/index', $data);
		} else {
			$this->load->view('themes/default/template/payment/index', $data);
			
		}
	}
	
	function savepayu(){
		if(checkModification()){
		$this->setting->update('payu_enable',$this->input->post('payu_enable'));
		$this->setting->update('payu_test',$this->input->post('payu_test'));  
		$this->setting->update('payu_key',$this->input->post('payu_key'));
		$this->setting->update('payu_salt',$this->input->post('payu_salt'));  
		
		$this->session->set_flashdata('success','Updated Successfully');
	   	redirect('payment');
	   	}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('payment');
	    }  
	}

}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */