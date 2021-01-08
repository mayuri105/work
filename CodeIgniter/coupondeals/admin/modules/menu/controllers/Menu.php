<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('theme');
		
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/menu')) {
			$this->load->view('themes/' . $theme . '/template/common/menu', $data);
		} else {
			$this->load->view('themes/default/template/common/menu', $data);
		}
	}
	

}

/* End of file Sidebar.php */
/* Location: ./application/controllers/Sidebar.php */