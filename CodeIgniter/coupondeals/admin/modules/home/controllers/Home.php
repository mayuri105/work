<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Home extends MX_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('index_model', 'index');

		

	}

	public function index()

	{	

		$data =array();

		

		$theme = $this->session->userdata('admin_theme');
		
		$data['totalusers'] =$this->index->record_countusers();

		$data['totaldeals'] =$this->index->record_countdeals();

		

        if (file_exists(APPPATH . 'views/themes/'.$theme.'/template/common/index')) {

            $this->load->view('themes/'.$theme.'/template/common/index', $data);

        }else{

            $this->load->view('themes/default/template/common/index', $data);

        }

	}



	



	

}



/* End of file index.php */

/* Location: ./application/controllers/index.php */ ?>