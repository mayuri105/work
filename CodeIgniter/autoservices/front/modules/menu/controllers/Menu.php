<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller {

	public function __construct() {
		parent::__construct();
		
		
	}

	public function index()
	{
		$data = array();
		
		$theme = $this->session->userdata('front_theme');
		
		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/sidebar')) {
			$this->load->view('themes/' . $theme . '/template/common/sidebar', $data);
		} else {
			$this->load->view('themes/default/template/common/sidebar', $data);
		}
	}
	

}

/* End of file Sidebar.php */
/* Location: ./application/controllers/Sidebar.php */