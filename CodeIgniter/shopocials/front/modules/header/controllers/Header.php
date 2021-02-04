<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Header extends MX_Controller {

	public function __construct() {
		parent::__construct();

	}

	public function index() {
		$data = array();
		$theme = $this->session->userdata('front_theme');
		
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		} else {
			$this->load->view('themes/default/template/common/header', $data);
		}

	}
		public function slider() {
		$data = array();
		$theme = $this->session->userdata('front_theme');
		
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/slider')) {
			$this->load->view('themes/' . $theme . '/template/common/slider', $data);
		} else {
			$this->load->view('themes/default/template/common/slider', $data);
		}

	}

	

}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */