<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Coupon extends MX_Controller {

	public function __construct() {
		parent::__construct();		
		$this->load->model('coupon_model', 'coupon');
		$this->load->helper('date');
			$this->load->helper('url');
		$this->load->library('Pagination');
		$this->load->library('Paginationlib');
		
	}
	public function index() {
		$perpage = $this->setting->get('dealper_page');
		if($this->input->get('page'))	{

			$page = $this->input->get('page');

		}else{

			$page=1;

		}
		$base_url = "/coupon?";

		$t = $this->input->get();

		unset($t['page']);

        $base_url .= http_build_query($t);

		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->coupon->record_count());

		$data = array();

        $data["pagination_helper"]   = $this->pagination;


		$data["allcoupons"] = $this->coupon->fetch_data($perpage ,(($page-1) * $perpage));
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupon/coupons')) {
			$this->load->view('themes/' . $theme . '/template/coupon/coupons',$data);
		} else {
			$this->load->view('themes/default/template/coupon/coupons',$data);
		}
	}
	
	
	public function couponsidebar()
	{
		$data = array();
		//load view 
		$data['allletesdeal']= $this->coupon->getlatestdeal();
		$data['allfeaturebrands']= $this->coupon->getfeaturebrand();
		$theme = $this->session->userdata('front_theme');
		
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/couponbar')) {
			$this->load->view('themes/' . $theme . '/template/common/couponbar', $data);
		} else {
			$this->load->view('themes/default/template/common/couponbar', $data);
		}
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */


// 