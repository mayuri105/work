<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ajaxModel');
		$this->load->helper('url');
		//$this->load->library('form_validation');
	
	}

	
public function followbrand()


	{
		
		$this->load->library('form_validation');
	
	  $this->form_validation->set_rules('user_id', 'login', 'required'); 
		$this->form_validation->set_rules('brand_id', 'brand_id', 'required');
            
               
		if($this->form_validation->run() == FALSE){
       		$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
		$userData['user_id'] = post('user_id');
            $userData['brand_id'] =  post('brand_id');
            $userData['follow_status'] = '1';
            $ret = $this->ajaxModel->userfollow($userData);  
			   
				$return = array('n'=>1,'Type'=>'Success','Message'=>'Brand Foollow ');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
				

        }
    }

public function subscribe()


	{
		
		$this->load->library('form_validation');
	
	  $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_subscribe_user.email]'); 
	
               
		if($this->form_validation->run() == FALSE){
       		$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
		$data = array(
					
					'email' => post('email'),
					
					
					
				);
				$ret = $this->ajaxModel->insertsub($data);
            
				$return = array('n'=>1,'Type'=>'Success','Message'=>'Successfully Subscribed');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
				

        }
    }


}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */