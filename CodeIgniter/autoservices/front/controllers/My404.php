<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class My404 extends MX_Controller {



	public function __construct()

	{

		parent::__construct();

	}



	public function index()

	{

		$data =array();

		$data['title'] = $this->settings->get('site_name');

		$data['meta_descriptions'] = $this->settings->get('meta_descriptions');

		$data['meta_keywords'] = $this->settings->get('meta_keywords');

		$data['meta_titles'] = $this->settings->get('meta_titles');

		$theme = $this->session->userdata('front_theme');

		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/error_404')) {

            $this->load->view('themes/' . $theme . '/template/common/error_404', $data);

        }else{

            $this->load->view('themes/default/template/common/error_404', $data);

        }

        

	}



}



/* End of file My404.php */

/* Location: ./application/controllers/My404.php */