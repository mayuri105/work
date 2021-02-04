<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('index_model', 'index');
		
		
		
	}

	public function index(){
		
		$data =array();
		$data['bodyclass'] ='page-home';
		//$data['products'] = $this->index->getproducts();
		$data['meta_titles']  = $this->setting->get('meta_titles');
		$data['meta_descriptions']  = $this->setting->get('meta_descriptions');
		$data['title']  = $this->setting->get('meta_titles');
		$theme = $this->session->userdata('front_theme');
		
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/index')) {
            $this->load->view('themes/' . $theme . '/template/common/index', $data);
        }else{
            $this->load->view('themes/default/template/common/index', $data);
        }
   	}
   	
   	

	

}	

/* End of file index.php */
/* Location: ./application/controllers/index.php */ 
