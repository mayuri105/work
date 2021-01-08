<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		// usergroups rights checked here helper class function checkRights
		!checkRights() ? show_error('You dont have permission for this page', 403) :'' ;
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
		$data['store_name'] = $this->input->get('store_name');
		$data['tip'] = $this->input->get('tip');
		$data['sector'] = $this->input->get('sector');
		$data['group'] = $this->input->get('group');
		$data['order_status_id'] = $this->input->get('order_status_id');
		$data['store_type'] = $this->reports->getStoreType();
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
		$data['store_name'] = $this->input->get('store_name');
		$data['sector'] = $this->input->get('sector');
		$data['group'] = $this->input->get('group');
		$data['order_status_id'] = $this->input->get('order_status_id');

		$data['store_type'] = $this->reports->getStoreType();
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
		$data['store_name'] = $this->input->get('store_name');
		$data['sector'] = $this->input->get('sector');
		
		$data['order_status_id'] = $this->input->get('order_status_id');
		$data['store_type'] = $this->reports->getStoreType();
		$data['stores'] = $this->reports->getStores();
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
	

	public function sponsored_listing_report(){
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['sector'] = $this->input->get('sector');
		$data['group'] = $this->input->get('group');
		$data['store_type'] = $this->reports->getStoreType();
		$data['ads_order'] = $this->reports->getAds_order();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/sponsored-listing-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/sponsored-listing-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/sponsored-listing-report', $data);
		}
	}

	public function commission_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		$data['merchant'] = $this->input->get('merchant');
		$data['group'] = $this->input->get('group');

		$data['merchant'] = $this->reports->getMerchant();
		$data['commission'] = $this->reports->getCommission();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/commission-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/commission-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/commission-report', $data);
		}
	}

	public function coupon_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		
		$data['group'] = $this->input->get('group');
		$data['coupons'] = $this->reports->getCoupon();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/coupon-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/coupon-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/coupon-report', $data);
		}
	}
	public function tip_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		
		$data['group'] = $this->input->get('group');
		$data['tips'] = $this->reports->gettip();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/tip-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/tip-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/tip-report', $data);
		}
	}
	
	public function profit_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		
		$data['group'] = $this->input->get('group');
		$data['profits'] = $this->reports->getTotalProfits();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/profit-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/profit-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/profit-report', $data);
		}
	}

	public function customer_orders_report(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['date_start'] = date('d-m-Y',strtotime($this->input->get('date_start')));
		$data['date_end'] = date('d-m-Y',strtotime($this->input->get('date_end')));
		
		$data['order_status_id'] = $this->input->get('order_status_id');
		$data['customer_orders'] = $this->reports->getCustomerOrders();
		$data['order_status'] = $this->reports->getOrderStatus();
		$data['mode'] = $this->input->get('group') ? $this->input->get('group')  :'week';
		//load view 
		if (file_exists(APPPATH . 'views/themes/'. $theme.'/template/reports/customer-orders-report')) {
			$this->load->view('themes/'. $theme.'/template/reports/customer-orders-report', $data);
		} else {
			$this->load->view('themes/default/template/reports/customer-orders-report', $data);
		}
	}




}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */