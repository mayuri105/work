<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bid_details extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('bid_details_models', 'bid_details');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_details/index')) {
			$this->load->view('themes/' . $theme . '/template/bid_details/index', $data);
		} else {
			$this->load->view('themes/default/template/bid_details/index', $data);

		}
	}
	

}

/* End of file Bid_details.php */
/* bid_details: ./application/controllers/Amenites.php */