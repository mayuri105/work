<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupons extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('coupons_model', 'coupons');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
		
	}

	public function index()
	{
		$perpage = $this->setting->get('per_page');
		$data = array();
		
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/coupons/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t); 
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->coupons->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["coupons"] = $this->coupons->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupons/index')) {
			$this->load->view('themes/' . $theme . '/template/coupons/index', $data);
		} else {
			$this->load->view('themes/default/template/coupons/index', $data);
			
		}

	}
	// add coupon method
	public function add()
	{
		$data = array();
		
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupons/add')) {
			$this->load->view('themes/' . $theme . '/template/coupons/add', $data);
		} else {
			$this->load->view('themes/default/template/coupons/add', $data);
		}

	}
	// add coupon submit method
	public function addcoupon(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('coupon_name', 'Coupon Name', 'required');
        $this->form_validation->set_rules('coupon_code', 'Code', 'required');
        $this->form_validation->set_rules('discount', 'Discount', 'numeric');
       	if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('coupons/add');
	        }else{
	        	
	        	$data= array(
	        		'coupon_name'=>post('coupon_name'),
	        		'coupon_code'=>post('coupon_code'),
	        		'type'=>post('type'),
	        		'discount'=>post('discount'),
	        		'total_amount'=>post('total_amount'),
	        		'date_start'=>date('Y-m-d',strtotime(post('start'))),
	        		'date_end'=>date('Y-m-d',strtotime(post('end'))),
	        		'uses_per_coupon'=>post('uses_per_coupon'),
	        		'status'=>post('status'),
				);	

	        	$ret = $this->coupons->insert($data);

	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Coupons added',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);

	        		$this->session->set_flashdata('success','Coupons Created');
	        		redirect('coupons/add');
	        	}else{
		        	$this->session->set_flashdata('error','Error in insert');
		           redirect('coupons/add');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('coupons');
	    }
	}
	// edit view method
	public function edit($id ='')
	{
		
		if(empty($id)){
			redirect('coupons');
		} 
		$data = array();
		$coupons = $this->coupons->getcouponsbyid($id);
		$data['coupons'] = $coupons;
        $data['coupon_history'] = $this->coupons->getcouponsHistorybyid($id);;
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupons/edit')) {
			$this->load->view('themes/' . $theme . '/template/coupons/edit', $data);
		} else {
			$this->load->view('themes/default/template/coupons/edit', $data);
		}

	}
	// update coupon method
	public function updatecoupon(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('coupon_name', 'Coupon Name', 'required');
        $this->form_validation->set_rules('coupon_code', 'Code', 'required');
        $this->form_validation->set_rules('discount', 'Discount', 'numeric');
       	if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('coupons/edit/'.post('c_id').'');
	        }else{
	        	
	        	
	        	$data= array(
	        		'coupon_name'=>post('coupon_name'),
	        		'coupon_code'=>post('coupon_code'),
	        		'type'=>post('type'),
	        		'discount'=>post('discount'),
	        		'total_amount'=>post('total_amount'),
	        		'date_start'=>date('Y-m-d',strtotime(post('start'))),
	        		'date_end'=>date('Y-m-d',strtotime(post('end'))),
	        		'uses_per_coupon'=>post('uses_per_coupon'),
	        		'uses_per_customer'=>post('uses_per_customer'),
	        		'status'=>post('status'),
				);	
	        	$where = array('c_id'=>post('c_id'));
	        	$ret = $this->coupons->update($data,$where);

	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Coupons Updated',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);

	        		$this->session->set_flashdata('success','Coupons Updated');
	        		redirect('coupons/edit/'.post('c_id').'');
	        	}else{
		        	$this->session->set_flashdata('error','Error in insert');
		           redirect('coupons/edit/'.post('c_id').'');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('coupons');
	    }
	}
	// get coupon json method
	function getcoupons(){
		$id = post('id');
		$ret =  $this->coupons->getcouponsbyid($id);
		echo  json_encode($ret);
		exit;
	}
	// delete coupon
	function delete($id){
		if($id =='') redirect('coupons');
		
		$ret =  $this->coupons->delete($id);
		if($ret){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				$ret =  $this->coupons->delete($u);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        $this->output->set_content_type('application/json')->set_output(json_encode('1'));
	    }
	}
	// ajax search method 
	function search(){

		$data = array();
		$data["coupons"] = $this->coupons->fetch_data_bysearch();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/coupons/search')) {
			$this->load->view('themes/' . $theme . '/template/coupons/search', $data);
		} else {
			$this->load->view('themes/default/template/coupons/search', $data);
			
		}
	}

}	

/* End of file coupons.php */
/* Location: ./application/controllers/coupons.php */