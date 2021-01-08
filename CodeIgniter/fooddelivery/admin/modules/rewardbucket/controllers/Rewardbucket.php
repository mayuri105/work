<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rewardbucket extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('rewardbucket_model', 'rewardbucket');
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
		$base_url = "/rewardbucket/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->rewardbucket->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["rewardbuckets"] = $this->rewardbucket->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/rewardbucket/index')) {
			$this->load->view('themes/' . $theme . '/template/rewardbucket/index', $data);
		} else {
			$this->load->view('themes/default/template/rewardbucket/index', $data);
			
		}

	}
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('points_reward', 'Points reward', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		if(checkModification()){
	        if($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('rewardbucket');
	        }else{
	        	$image = '';
	            $upload_path =  $this->config->item('upload_path').'/rewardbucket';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);

	        	if($this->upload->do_upload('fileinput')){
	        		$image = $this->upload->data();
	            		$data= array(
	            			'title'=>post('title'),
			        		'points_reward'=>post('points_reward'),
			        		'image'=>$image['file_name'],
			        		'description'=>post('description'),
			        		'credits'=>post('credits'),
			        		
			        	);	
			        	$ret = $this->rewardbucket->insert($data);
	               
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('rewardbucket');
	               

		        }else{
		        	$this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('rewardbucket');
		        }
	        	if($ret){
	        		$this->session->set_flashdata('success','rewardbucket Added');
	        		redirect('rewardbucket');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('rewardbucket');
		        }
	        }
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('rewardbucket');
		}

	}

	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('points_reward', 'Points reward', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('rewardbucket');
	        }else{
	        	$image = '';
	            $upload_path =  $this->config->item('upload_path').'/rewardbucket';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	            
	        	if($this->upload->do_upload('fileinput')){
	                    $image = $this->upload->data();
	                   	$data= array(
	                   		'title'=>post('title'),
			        		'points_reward'=>post('points_reward'),
			        		'image'=>$image['file_name'],
			        		'description'=>post('description'),
			        	);	
			        	$where = array('rb_id'=>post('rb_id'));	
			        	$ret = $this->rewardbucket->update($data,$where );

		        }else{
	        		$data= array(
	        			'title'=>post('title'),
		        		'points_reward'=>post('points_reward'),
		        		'description'=>post('description'),
		        		'credits'=>post('credits'),
		        	);
		        	$where = array('rb_id'=>post('rb_id'));		
		        	$ret = $this->rewardbucket->update($data,$where );
		        }
        		$this->session->set_flashdata('success','rewardbucket Updated');
        		redirect('rewardbucket');
	        	
	        }
	    }else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('rewardbucket');
		}
	}
	function getrewardbucket(){
		$id = post('id');
		$ret =  $this->rewardbucket->getrewardbucketbyid($id);
		echo  json_encode($ret);
		exit;
	}
	function delete($id){
		if(checkModification()){
			$ret =  $this->rewardbucket->delete($id);
			if($ret){
				echo 'success';
			}else{
				echo 'error';
			}
		}else{
			$this->session->set_flashdata('warnings','You do not have permission to modify');
	       	echo 'error';
		}
	}
	
	public function search(){

		$data = array();
		$data["rewardbuckets"] = $this->rewardbucket->fetch_data_bysearch();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/rewardbucket/search')) {
			$this->load->view('themes/' . $theme . '/template/rewardbucket/search', $data);
		} else {
			$this->load->view('themes/default/template/rewardbucket/search', $data);
			
		}
	}
	
}

/* End of file Rewardbucket.php */
/* Location: ./application/controllers/Rewardbucket.php */