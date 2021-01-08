<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adspackage extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('adspackage_model', 'adspackage');
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
		$perpage = $this->setting->get('per_page');
		$base_url = "/adspackage/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->adspackage->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["adspackage"] = $this->adspackage->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/adspackage/index')) {
			$this->load->view('themes/' . $theme . '/template/adspackage/index', $data);
		} else {
			$this->load->view('themes/default/template/adspackage/index', $data);
			
		}
	}

	public function add(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_name', 'Package name', 'required');
		$this->form_validation->set_rules('package_price', 'Package price', 'required');
		$this->form_validation->set_rules('package_periods', 'Package periods', 'required');
		
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('adspackage');
	        }else{
	        	$data  = array(
					'package_name' => post('package_name'),
					'package_price' => post('package_price'),
					'package_periods' => post('package_periods'), 
					'added_date'=>date('Y-m-d')
				);
	        	$ret = $this->adspackage->insert($data);
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Ads package added',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);
	        		$this->session->set_flashdata('success','Ads package Added');
	        		redirect('adspackage');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('adspackage');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('adspackage');
	    }
	}

	public function update(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_name', 'Package name', 'required');
		$this->form_validation->set_rules('package_price', 'Package price', 'required');
		$this->form_validation->set_rules('package_periods', 'Package periods', 'required');
		
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('adspackage');
	        }else{
	        	$data  = array(
					'package_name' => post('package_name'),
					'package_price' => post('package_price'),
					'package_periods' => post('package_periods'), 
				);

	        	$where = array('asp_id' =>post('asp_id'));
	        	$ret = $this->adspackage->update($data,$where);
	        	
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Ads package added',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);
	        		$this->session->set_flashdata('success','Ads package added');
	        		redirect('adspackage');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('adspackage');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('adspackage');
	    }
	}


	function getpackage(){
		$id = post('id');
		$ret =  $this->adspackage->getpackagebyid($id);
		echo  json_encode($ret);
		exit;
	}
	// multiple delete method
	function deletemultiple(){
		if(checkModification()){	
			foreach ($this->input->post('delete') as $u) {
				$this->session->set_flashdata('success','Deleted Successfully  ');
				$ret =  $this->adspackage->delete($u);
				echo json_encode($ret);
			}
		}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	       echo json_encode('0');
	    }
		

		exit;
	}


	public function orders($page ='1')
	{
		$data = array();
		$perpage = $this->setting->get('per_page');
		$data = array();
		
		$pagingConfig   = $this->paginationlib->initPagination("/adspackage/orders",$perpage,$this->adspackage->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["adsorder"] = $this->adspackage->getReqOrders($perpage ,(($page-1) * $perpage));

		$theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/adspackage/order')) {
			$this->load->view('themes/' . $theme . '/template/adspackage/order', $data);
		} else {
			$this->load->view('themes/default/template/adspackage/order', $data);
		}	
	}

	function approvedPackage(){
		if (post('ajax')) {
			$ret = $this->adspackage->updateAdPackage();
			echo json_encode($ret);
		}

	}
	function disapprovedPackage(){
		if (post('ajax')) {
			$ret = $this->adspackage->updateAdPackageDis();
			echo json_encode($ret);
		}
	}

}	

/* End of file adspackage.php */
/* Location: ./application/controllers/adspackage.php */