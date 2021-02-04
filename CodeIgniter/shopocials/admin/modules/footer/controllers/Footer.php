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
		$data['site_name'] = $this->setting->get('site_name');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/footer.php')) {
			$this->load->view('themes/' . $theme . '/template/common/footer', $data);
		} else {
			$this->load->view('themes/default/template/common/footer', $data);
		}
	}
	public function jsscript()
	{
		$data = array();
            
		//load view 
		$theme = $this->session->userdata('theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/jsscript.php')) {
			$this->load->view('themes/' . $theme . '/template/common/jsscript', $data);
		} else {
			$this->load->view('themes/default/template/common/jsscript', $data);
		}
	}

}

/* End of file footer.php */
/* Location: ./application/controllers/footer.php */ ?>