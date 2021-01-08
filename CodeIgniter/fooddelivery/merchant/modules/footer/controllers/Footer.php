<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
            
		//load view 
		$theme = $this->session->userdata('theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/footer')) {
			$this->load->view('themes/' . $theme . '/template/common/footer', $data);
		} else {
			$this->load->view('themes/default/template/common/footer', $data);
		}
	}

}

/* End of file footer.php */
/* Location: ./application/controllers/footer.php */ ?>