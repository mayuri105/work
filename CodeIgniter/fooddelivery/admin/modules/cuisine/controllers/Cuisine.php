<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuisine extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cuisine_model', 'cuisine');
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
		
		$base_url = "/cuisine/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->cuisine->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["cuisines"] = $this->cuisine->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cuisine/index')) {
			$this->load->view('themes/' . $theme . '/template/cuisine/index', $data);
		} else {
			$this->load->view('themes/default/template/cuisine/index', $data);
			
		}

	}

	// add cuisine method
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cuisine_type', 'Cuisine type', 'required');
		if(checkModification()){
			if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('cuisine');
	        }else{
	        	$image = '';
	            $upload_path =  $this->config->item('upload_path').'/cuisine';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);


	        	if($this->upload->do_upload('fileinput')){
	                $image = $this->upload->data();

	    			if ($this->upload->do_upload('fileinput2') ) {
	                    
	                   	$image2 = $this->upload->data();

	                   	$data= array(
			        		'cusine_type'=>post('cuisine_type'),
			        		'cuisine_image_url'=>$image['file_name'],
			        		'banner_image'=>$image2['file_name'],
			        		'status'=>post('status'),
			        		'featured_on'=>post('featured_on'),
			        	);	
			        	$ret = $this->cuisine->insert($data);
	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('cuisine');
	                }

		        }else{
		        	if ($this->upload->do_upload('fileinput2')) {
	                    $image = $this->upload->data();
	                   	$data= array(
			        		'cusine_type'=>post('cuisine_type'),
			        		'banner_image'=>$image['file_name'],
			        		'status'=>post('status'),
			        		'featured_on'=>post('featured_on'),
			        	);	
			        	$ret = $this->cuisine->insert($data);
	                }else{
	                	$this->session->set_flashdata('error',$this->upload->display_errors());
	                 	redirect('cuisine');
	                }
	        	}
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'cuisine added',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);


	        		$this->session->set_flashdata('success','cuisine Added');
	        		redirect('cuisine');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('cuisine');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('cuisine');
	    }    
	}
	// update cuisine method
	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cusine_type', 'cusine_type', 'required');
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('cuisine');
	        }else{
				$image = '';
				$upload_path =  $this->config->item('upload_path').'/cuisine';

				if (!file_exists($upload_path)) {
					mkdir($upload_path, 0777, true);
				}
				$c_upload['upload_path']    =  $upload_path;
				$c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
				$this->load->library('upload', $c_upload);
	        	if($this->upload->do_upload('fileinput')){
	               
	    			if ($this->upload->do_upload('fileinput')) {
	                    $image = $this->upload->data();
	                   
	                   	$data= array(
			        		'cusine_type'=>post('cusine_type'),
			        		'cuisine_image_url'=>$image['file_name'],
			        		'status'=>post('status'),
			        		'featured_on'=>post('featured_on'),
			        	);
			        	$where = array('cu_id'=>post('cu_id'));	
			        	$ret = $this->cuisine->update($data,$where );
	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('cuisine');
	                }

		        }elseif ($this->upload->do_upload('fileinput2')) {
		        	if ($this->upload->do_upload('fileinput2')) {
	                    $image = $this->upload->data();
	                   
	                   	$data= array(
			        		'cusine_type'=>post('cusine_type'),
			        		'banner_image'=>$image['file_name'],
			        		'status'=>post('status'),
			        		'featured_on'=>post('featured_on'),
			        	);
			        	$where = array('cu_id'=>post('cu_id'));	
			        	$ret = $this->cuisine->update($data,$where );
	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('cuisine');
	                }
		        }elseif ($this->upload->do_upload('fileinput') && $this->upload->do_upload('fileinput2') ) {
		        	if($this->upload->do_upload('fileinput')){
	                	$image = $this->upload->data();
		    			if ($this->upload->do_upload('fileinput2') ) {
		                    
		                   	$image2 = $this->upload->data();

		                   	$data= array(
				        		'cusine_type'=>post('cuisine_type'),
				        		'cuisine_image_url'=>$image['file_name'],
				        		'banner_image'=>$image2['file_name'],
				        		'status'=>post('status'),
			        			'featured_on'=>post('featured_on'),
				        	);	
				        	$where = array('cu_id'=>post('cu_id'));	
			        		$ret = $this->cuisine->update($data,$where );
		                } else {
		                  $this->session->set_flashdata('error',$this->upload->display_errors());
		                  redirect('cuisine');
		                }
	            	}

		        }
		        else{
	        		$data= array(
		        		'cusine_type'=>post('cusine_type'),
		        		'status'=>post('status'),
			        	'featured_on'=>post('featured_on'),
		        	);
		        	$where = array('cu_id'=>post('cu_id'));		
		        	$ret = $this->cuisine->update($data,$where );
		        }

	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Cuisine Updated',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);
	        		$this->session->set_flashdata('success','Cuisine Updated');
	        		redirect('cuisine');
	        	}else{

		        	$this->session->set_flashdata('error','Error in update');
		            redirect('cuisine');
		        }
	        }
        }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('cuisine');
	    }
	}
	// get cuisine json method
	function getcuisine(){
		$id = post('id');
		$ret =  $this->cuisine->getcuisinebyid($id);
		echo  json_encode($ret);
		exit;
	}
	// ajax search method
	public function search(){

		$data = array();
		$data["cuisines"] = $this->cuisine->fetch_data_bysearch();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/cuisine/search')) {
			$this->load->view('themes/' . $theme . '/template/cuisine/search', $data);
		} else {
			$this->load->view('themes/default/template/cuisine/search', $data);
			
		}
	}
	// multiple delete method
	function deletemultiple(){
		foreach ($this->input->post('delete') as $u) {
			
			$ret =  $this->cuisine->delete($u);
		}
		if($ret){
			$this->session->set_flashdata('success','Deleted Successfully  ');
			echo json_encode($ret);
		}else{
			$this->session->set_flashdata('error','Item Currently being used');
			echo json_encode($ret);
		}
	}
}	

/* End of file cuisine.php */
/* Location: ./application/controllers/cuisine.php */