<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversion extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		// usergroups rights checked here helper class function checkRights
		$this->load->model('conversion_model', 'conversion');
	}
	public function index()
	{
		$perpage = $this->setting->get('per_page');
		$data = array();
		$data['users'] = $this->conversion->getMessageUser();
		$data['merchant'] = $this->conversion->getMerchantMessage();
		$data['allusers'] = $this->conversion->getusers();
		$data['allmerchant'] = $this->conversion->getmerchant();
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/conversion/index')) {
			$this->load->view('themes/' . $theme . '/template/conversion/index', $data);
		} else {
			$this->load->view('themes/default/template/conversion/index', $data);
			
		}
	}

	public function add(){
		$theme = $this->session->userdata('admin_theme');
		//load view 
		$data = array();
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/conversion/add')) {
			$this->load->view('themes/' . $theme . '/template/conversion/add', $data);
		} else {
			$this->load->view('themes/default/template/conversion/add', $data);
			
		}
	}


	public function sendconversion(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('message', 'message', 'required');
       	
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	        }else{
	        	$sender_id = $this->session->userdata('m_id');

	        	$data= array(
	        		'receiver_id'=>post('user_id'),
	        		'receiver_type'=>post('user_type'),
	        		'sender_id'=>$sender_id,
	        		'sender_type'=>'merchant',
	        		'message'=>post('message'),
	        		'message_read'=>'0',
	        		'send_date'=>date('Y-m-d H:i:s'),
	        		'added_date'=>date('Y-m-d')
				);	
	        	$ret = $this->conversion->insert($data);
	        }

	   	$user_id = post('user_id');
		$user_type = post('user_type');
		$data['message'] =$this->conversion->getmessage($user_id,$user_type);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/conversion/chat')) {
			$this->load->view('themes/' . $theme . '/template/conversion/chat', $data);
		} else {
			$this->load->view('themes/default/template/conversion/chat', $data);
			
		}
	}

	public function loadchat(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$user_id = post('user_id');
		$user_type = post('user_type');
		$data['message'] =$this->conversion->getmessage($user_id,$user_type);
		$this->conversion->setReadMsg($user_id,$user_type);
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/conversion/chat')) {
			$this->load->view('themes/' . $theme . '/template/conversion/chat', $data);
		} else {
			$this->load->view('themes/default/template/conversion/chat', $data);
		}
	}
	public function search(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$search = post('search');
		$data['allusers'] = $this->conversion->getUserBySearch($search);
		$data['allmerchant'] = $this->conversion->getmerchantBySearch($search);

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/conversion/user')) {
			$this->load->view('themes/' . $theme . '/template/conversion/user', $data);
		} else {
			$this->load->view('themes/default/template/conversion/user', $data);
		}


	}

}

/* End of file Conversion.php */
/* Location: ./controllers/Conversion.php */