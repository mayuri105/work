<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Header extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		
	}

	public function index()
	{
			
		
	  	
	 
		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		}else{
			$this->load->view('themes/default/template/common/header', $data);
		}
	}
	
	
	
	
}


/* End of file Header.php */
/* Location: ./application/controllers/Header.php */