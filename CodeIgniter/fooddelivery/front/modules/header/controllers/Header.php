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
		$this->load->model('account/account_model', 'account');

		$data['points'] = $this->account->getTotalEarnpoints();
		$data['refbycredits'] = $this->setting->get('refbycredits');
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		if (is_login()) {
			$ref = $this->account->getcustomerbyid($this->session->c_id);
			$data['refbycode'] = $ref->customer_detail->share_code;
			$data['username'] = $ref->customer_detail->first_name.' '.$ref->customer_detail->last_name;
		}
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		} else {
			$this->load->view('themes/default/template/common/header', $data);
		}

	}

	public function account() {
		$data = array();
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');

		$this->load->model('account/account_model', 'account');
		$data['refbycredits'] = $this->setting->get('refbycredits');

		if (is_login()) {
			$ref = $this->account->getcustomerbyid($this->session->c_id);
			$data['refbycode'] = $ref->customer_detail->share_code;
			$data['username'] = $ref->customer_detail->first_name.' '.$ref->customer_detail->last_name;
		}
		$data['points'] = $this->account->getTotalEarnpoints();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/header')) {
			$this->load->view('themes/' . $theme . '/template/account/header', $data);
		} else {
			$this->load->view('themes/default/template/account/header', $data);
		}

	}

}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */