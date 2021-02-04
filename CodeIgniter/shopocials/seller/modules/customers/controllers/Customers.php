<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MX_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model','customer');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
		
	}

	public function index(){
		$data = array();
		$perpage = $this->setting->get('per_page');
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/customers/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->customer->record_count());
		
		$data["pagination_helper"]   = $this->pagination;
		$data["customers"] = $this->customer->fetch_data($perpage ,(($page-1) * $perpage));
		
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/customer/index')) {
			$this->load->view('themes/' . $theme . '/template/customer/index', $data);
		} else {
			$this->load->view('themes/default/template/customer/index', $data);
		}
	}

	
	function customerstatus($id){

	

			

			$ret = $this->customer->customerupdatestatus($id);

			$this->output->set_content_type('application/json')->set_output(json_encode($ret));

			$this->session->set_flashdata('success', 'Update Successfully  ');

		}

	
	function customerdelete($id) {



	$ret=$this->customer->customerdelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}

	
}	

/* End of file orders.php */
/* Location: ./application/controllers/orders.php */	