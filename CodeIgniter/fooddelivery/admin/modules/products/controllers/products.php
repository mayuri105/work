<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model', 'product');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
	}

	public function index()
	{
		$data = array();	
		$perpage = $this->setting->get('per_page');
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/products/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->product->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["products"] = $this->product->fetch_data($perpage ,(($page-1) * $perpage));
        
        $data['name'] = $this->input->get('name');
        $data['store_name'] = $this->input->get('store_name');
        $data['enable'] = $this->input->get('enable');
        $data['cuision'] = $this->input->get('cuision');
        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));
        $data['zipcode'] = $this->input->get('zipcode');
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/product/index')) {
			$this->load->view('themes/' . $theme . '/template/product/index', $data);
		} else {
			$this->load->view('themes/default/template/product/index', $data);
		}
	}
}

/* End of file product.php */
/* Location: ./application/controllers/product.php */ 