<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		// usergroups rights checked here helper class function checkRights
		$this->load->model('reports_model', 'reports');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
	}

	
	public function index()
	{
		redirect('reports/sector_sale');
	}

	public function sector_sale(){
		$data = array();
		$data['start_date'] = date('d-m-Y',strtotime($this->input->get('start_date')));
		$data['end_date'] = date('d-m-Y',strtotime($this->input->get('end_date')));
		$data['sector_collection'] = $this->reports->getSectorWiseSale();
		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/sector-sale')) {
			$this->load->view('themes/' . $theme . '/template/reports/sector-sale', $data);
		} else {
			$this->load->view('themes/default/template/reports/sector-sale', $data);
			
		}
	}

	public function sale_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['stores'] = $this->input->get('store');
		$data['tip'] = $this->input->get('tip');
		$data['sector'] = $this->input->get('sector');
		$data['group'] = $this->input->get('group');
		$data['order_status_id'] = $this->input->get('order_status_id');
		$data['store_type'] = $this->reports->getStoreType();
		$data['store'] = $this->reports->getStores();
		$data['order_status'] = $this->reports->getOrderStatus();
		$data['orders'] = $this->reports->getOrders();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/sale-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/sale-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/sale-report', $data);
			
		}
	}

	public function order_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['tip'] = $this->input->get('tip');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['stores'] = $this->input->get('store');
		$data['sector'] = $this->input->get('sector');
		$data['group'] = $this->input->get('group');
		$data['order_status_id'] = $this->input->get('order_status_id');

		$data['store_type'] = $this->reports->getStoreType();
		$data['store'] = $this->reports->getStores();
		$data['order_status'] = $this->reports->getOrderStatus();
		$data['orders'] = $this->reports->getOrders();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/order-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/order-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/order-report', $data);
			
		}
	}

	public function product_purchased_report($page=1){
		$data = array();
		$perpage = $this->setting->get('per_page');
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['stores'] = $this->input->get('store');
		$data['sector'] = $this->input->get('sector');
		
		$data['order_status_id'] = $this->input->get('order_status_id');
		$data['store_type'] = $this->reports->getStoreType();
		$data['store'] = $this->reports->getStores();
		$data['order_status'] = $this->reports->getOrderStatus();
		$total = $this->reports->getTotalProductsPurchased();
		$pagingConfig   = $this->paginationlib->initPagination("/reports/product_purchased_report",$perpage,$total);
        $data["pagination_helper"]   = $this->pagination;
       	
		$data['products'] = $this->reports->getProductsPurchased($perpage ,(($page-1) * $perpage));
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/reports/product-purchased-report')) {
			$this->load->view('themes/' . $theme . '/template/reports/product-purchased-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/product-purchased-report', $data);
		}

	}
	public function commission_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['merchant'] = $this->reports->getMerchant();
		$data['commission'] = $this->reports->getCommission();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		$data['group'] = $this->input->get('group');
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/commission-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/commission-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/commission-report', $data);
		}
	}
	public function tip_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['tips'] = $this->reports->gettip();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		$data['group'] = $this->input->get('group');
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/tip-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/tip-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/tip-report', $data);
		}
	}
	
	

}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */