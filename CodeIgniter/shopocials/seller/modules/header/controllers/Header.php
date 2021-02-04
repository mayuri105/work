<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header extends MX_Controller {

	public function __construct()
	{
		parent::__construct();	
	}

	public function index()
	{	
		
		$data = array();
    	  $data['site_name'] = $this->setting->get('site_name');
    	
		$theme = $this->session->userdata('theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		}else{
			$this->load->view('themes/default/template/common/header', $data);
		}
	}
	public function head()
	{	
		
		$data = array();
    	
    	$data['site_name'] = $this->setting->get('site_name');
    	
		$theme = $this->session->userdata('theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/head.php')) {
			$this->load->view('themes/' . $theme . '/template/common/head', $data);
		}else{
			$this->load->view('themes/default/template/common/head', $data);
		}
	}
	
}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */