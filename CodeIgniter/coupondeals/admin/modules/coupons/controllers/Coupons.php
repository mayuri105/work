<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupons extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('coupons_models', 'coupons');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('image_lib');
	}

	public function index() {
		$data = array();
		$perpage = $this->setting->get('per_page');
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/coupons/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->coupons->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["coupons"] = $this->coupons->fetch_data($perpage, (($page - 1) * $perpage));
		$data['coupons_par'] = $this->coupons->getCoupon();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupon/index')) {
			$this->load->view('themes/' . $theme . '/template/coupon/index', $data);
		} else {
			$this->load->view('themes/default/template/coupon/index', $data);

		}
	}
	// add categories form page
	public function addcoupons() {
		$data = array();
	$data['brands'] = $this->coupons->getbrand();
		$theme = $this->session->userdata('admin_theme');
		//$data['brands_par'] = $this->coupons->getBrand();
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupon/add')) {
			$this->load->view('themes/' . $theme . '/template/coupon/add', $data);
		} else {
			$this->load->view('themes/default/template/coupon/add', $data);

		}

	}
	// edit categories form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('coupons');
		}
		$data = array();
		$data['coupons'] = $this->coupons->getcouponByid($id);
		$data['brands'] = $this->coupons->getbrand();
		$data['coupons_par'] = $this->coupons->getCoupon();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupon/edit')) {
			$this->load->view('themes/' . $theme . '/template/brand/edit', $data);
		} else {
			$this->load->view('themes/default/template/coupon/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
		

		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('coupons/addcoupons');
			} else {
				$data = array(
					'brand_id' => post('brand_id'),
					'title' => post('title'),
					'coupon_code' => post('coupon_code'),
					'coupon_desc' => post('coupon_desc'),
					'coupon_link' => post('coupon_link'),
					'start_date' => post('start_date'),
					'expired_date' => post('expired_date'),
					
					

				);

				$ret = $this->coupons->insert($data);
				
				$this->session->set_flashdata('success', 'coupons Added');
				redirect('coupons');
				
				
				
		}
			
		
	}

	
	public function updatecoupon() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('coupons/edit/'. post('coupon_id') . '');
			} else {
				$data = array(
					'brand_id' => post('brand_id'),
					'title' => post('title'),
					'coupon_code' => post('coupon_code'),
					'coupon_desc' => post('coupon_desc'),
					'coupon_link' => post('coupon_link'),
					'start_date' => post('start_date'),
					'expired_date' => post('expired_date'),
					
					

				);

				$where = array('coupon_id' => post('coupon_id'));
				$ret = $this->coupons->update($data, $where);
				
				$this->session->set_flashdata('success', 'coupons Updated');
				redirect('coupons');
			}
		
	}
			
	function delete($id) {

	$ret=$this->coupons->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}
function status($id){

		
		$ret = $this->coupons->updatestatus($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		$this->session->set_flashdata('success', 'Update Successfully  ');
	}
	
}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */