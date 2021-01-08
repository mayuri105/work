<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('banner_model', 'banners');
		
	}

	public function index()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('front_theme');
		$data['banners'] = $this->banners->getBanner();
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/banner')) {
			$this->load->view('themes/' . $theme . '/template/common/banner', $data);
		} else {
			$this->load->view('themes/default/template/common/banner', $data);
		}
	}
	

}

/* End of file Sidebar.php */
/* Location: ./application/controllers/Sidebar.php */