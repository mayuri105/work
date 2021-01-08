<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Account extends MX_Controller { 


	public function __construct() {
		parent::__construct();
		$this->load->model('account/account_models', 'account');
		!is_login() ? redirect('index') :''; 
		
	}


	public function index() {
		$data = array();
		$theme = $this->session->userdata('front_theme');
		
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['appointment'] = $this->account->getAppointment();
		$data['package'] = $this->account->getPackage();
		$data['customer'] = getActiveCustomerInfo();
		
		$open_day  = $this->setting->get('open_day');
		$data['open_day'] = explode(',', $open_day);	
			
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/index')) {
			$this->load->view('themes/' . $theme . '/template/account/index', $data);
		} else {
			$this->load->view('themes/default/template/account/index', $data);
		}

	}
	
	public function updateprofile(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First name ', 'required');
       	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
       	$this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[12]');
       
        if ($this->form_validation->run() == FALSE){
        	$return  = array('Type'=> 'error', 'Message' =>validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
        	$cust = getActiveCustomerInfo();
			$data = array(
        		
        		'first_name'=>post('first_name'),
        		'last_name'=>post('last_name'),
        		'email'=>post('email'),
        		'phone'=>post('phone'),
        	);
        	$where = array('c_id'=>$cust->c_id);
        	$ret = $this->account->updateprofile($data,$where );
        	$return  = array('n' =>'1','Type'=> 'Success', 'Message' =>'Updated Successfully');
			$this->output->set_content_type('application/json')->set_output(json_encode($return));
        }
	}
	public function changepw(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpassword', 'Old password ', 'required');
       	$this->form_validation->set_rules('password', 'password', 'required');
       	$this->form_validation->set_rules('confpassword', 'Confirm password', 'required|matches[password]');
       
        if ($this->form_validation->run() == FALSE){
        	$return  = array('Type'=> 'error', 'Message' =>validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
        	$cust = getActiveCustomerInfo();
        	$this->load->library('encrypt');

        	$password =  $this->encrypt->decode($cust->password);

        	if (post('oldpassword') == $password){
        		$newpass = $this->encrypt->encode(post('password'));
        		$data =array(
        			'password'=>$newpass
        		);

        		$where = array('c_id'=>$cust->c_id);
	        	$ret = $this->account->updateprofile($data,$where );
	        	$return  = array('n' =>'1','Type'=> 'Success', 'Message' =>'Updated Successfully');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
        	}else{
        		$return  = array('Type'=> 'error', 'Message' =>'Old Password not match');
        		$this->output->set_content_type('application/json')->set_output(json_encode($return));
        	}        	
        }
	}
}