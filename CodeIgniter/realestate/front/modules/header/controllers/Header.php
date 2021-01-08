<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Header extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('index/index_model', 'index');
		$this->load->library('cart');
	}

	public function index() {
		$data = array();
		$theme = $this->session->userdata('front_theme');
		
		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['instagram'] = $this->setting->get('instagram');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['page'] = $this->index->getPage();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		} else {
			$this->load->view('themes/default/template/common/header', $data);
		}

	}
	public function bid() {
		$data = array();
		$theme = $this->session->userdata('front_theme');
		
		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['instagram'] = $this->setting->get('instagram');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['page'] = $this->index->getPage();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/bidding-header')) {
			$this->load->view('themes/' . $theme . '/template/common/bidding-header', $data);
		} else {
			$this->load->view('themes/default/template/common/bidding-header', $data);
		}

	}
	public function css(){
		$data = array();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/css')) {
			$this->load->view('themes/' . $theme . '/template/common/css', $data);
		} else {
			$this->load->view('themes/default/template/common/css', $data);
		}
	}

   	
}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */