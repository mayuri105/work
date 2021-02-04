<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$data =array();
		$this->load->model('home/index_model', 'index');
		$theme = $this->session->userdata('front_theme');
		$data['facebook'] = $this->setting->get('facebook');  
		$data['twitter'] = $this->setting->get('twitter');  
		$data['instagram'] = $this->setting->get('instagram');  
		$data['googleplus'] = $this->setting->get('googleplus');  
		$data['appstorelink'] = $this->setting->get('appstorelink');  
		$data['playstorelink'] = $this->setting->get('playstorelink'); 
		$data['google_api_key'] = $this->setting->get('google_api_key'); 
		$data['page'] = $this->index->getpage();
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/footer')) {
				$this->load->view('themes/' . $theme . '/template/common/footer', $data);
		}else{
				$this->load->view('themes/default/template/common/footer', $data);
		}

	}
	public function account()
	{
		$data =array();
		$this->load->model('index/index_model', 'index');

		$data['facebook'] = $this->setting->get('facebook');  
		$data['twitter'] = $this->setting->get('twitter');  
		$data['instagram'] = $this->setting->get('instagram');  
		$data['googleplus'] = $this->setting->get('googleplus');  
		$data['appstorelink'] = $this->setting->get('appstorelink');  
		$data['playstorelink'] = $this->setting->get('playstorelink');  
		$data['google_api_key'] = $this->setting->get('google_api_key'); 
		$data['page'] = $this->index->getpage();
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/account/footer')) {
				$this->load->view('themes/' . $theme . '/template/account/footer', $data);
		}else{
				$this->load->view('themes/default/template/account/footer', $data);
		}

	}
}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */