<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$data = array();
    	
    	//load view 
		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/messages')) {
			$this->load->view('themes/' . $theme . '/template/common/messages', $data);
		} else {
			$this->load->view('themes/default/template/common/messages', $data);
		}
	}

}

/* End of file message.php */
/* Location: ./application/controllers/message.php */