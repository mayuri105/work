<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');

	}

	public function index()
	{
		$data =array();
	
		$this->load->model('index/index_model', 'index');
		$theme = $this->session->userdata('front_theme');
			
		$data['mail'] = $this->setting->get('email_address');
		
		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['linkedin'] = $this->setting->get('linkedin');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['phone'] = $this->setting->get('phone');
		$data['aboutus'] = $this->setting->get('aboutus');
		$data['site_name'] = $this->setting->get('site_name');
		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['instagram'] = $this->setting->get('instagram');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['page'] = $this->index->getPage();
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['email_address'] = $this->setting->get('email_address');
 		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/footer')) {
				$this->load->view('themes/' . $theme . '/template/common/footer', $data);
		}else{
				$this->load->view('themes/default/template/common/footer', $data);
		}

	}

}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */