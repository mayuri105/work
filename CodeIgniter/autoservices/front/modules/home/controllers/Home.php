<?php if (!defined('BASEPATH')) {



	exit('No direct script access allowed');



}
class Home extends MX_Controller {

	public function __construct() {



		parent::__construct();
		$this->load->model('index_model', 'index');		
		$this->load->helper('url');
		$this->load->library('Pagination');
		$this->load->library('Paginationlib');
	}



	public function index() {

		$data =array();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/home/home')) {
			$this->load->view('themes/' . $theme . '/template/home/home',$data);
		} else {
			$this->load->view('themes/default/template/home/home',$data);
		}

	}



	

}





/* End of file index.php */



/* Location: ./application/controllers/index.php */











// 