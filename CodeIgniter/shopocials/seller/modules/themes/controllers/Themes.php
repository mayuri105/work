<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('theme_model', 'themem');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
	}
	// main page
	public function index()
	{
		
		$perpage = $this->setting->get(30);
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/theme/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->themem->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["themescn"] = $this->themem->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/theme/index')) {
			$this->load->view('themes/' . $theme . '/template/theme/index', $data);
		} else {
			$this->load->view('themes/default/template/theme/index', $data);
			
		}

	}
	// add page 
	
	public function update() {
		
                  	$data= array(
		        		'shop_theme'=>post('shop_theme'),
	        				        		
		        	);	
		        	$id =  $this->themem->getmerchant_wise_store(); 
		        	$where = array('shop_id'=>$id);
		        	$ret = $this->themem->update($data,$where);
		        	$this->session->set_flashdata('success', 'theme Saved');
					redirect('themes');
               
		
	}

}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */