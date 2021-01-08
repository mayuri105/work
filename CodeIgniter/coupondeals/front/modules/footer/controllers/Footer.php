<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('blog/blog_model', 'blog');
	}

	public function index()
	{
		$data = array();
        //$data['site_name']=$this->setting->get('site_name');
		//load view
		$data['aboutus'] = $this->setting->get('aboutus');
		$data['video_link'] = $this->setting->get('video_link'); 
		$data['allletestblog']= $this->blog->getlatesttwoblog();
		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/footer')) {
			$this->load->view('themes/' . $theme . '/template/common/footer', $data);
		} else {
			$this->load->view('themes/default/template/common/footer', $data);
		}
	}

}

/* End of file footer.php */
/* Location: ./application/controllers/footer.php */ ?>