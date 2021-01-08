<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model', 'category');
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
		
		$base_url = "/category/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->category->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["categories"] = $this->category->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/index')) {
			$this->load->view('themes/' . $theme . '/template/category/index', $data);
		} else {
			$this->load->view('themes/default/template/category/index', $data);
			
		}

	}

	// add category
	public function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'type', 'required');
		
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('category');
	        }else{
	        	$image = '';
	            $upload_path =  $this->config->item('upload_path').'/category';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);

	        	if($this->upload->do_upload('fileinput')){
	        		$image = $this->upload->data();
	                
	    			if ($this->upload->do_upload('fileinput2')) {
	                   	$image2 = $this->upload->data();
	                   
	                   	$data= array(
			        		'type'=>post('type'),
			        		'category_image_url'=>$image['file_name'],
			        		'type_banner_image'=>$image2['file_name'],
			        	);	
			        	$ret = $this->category->insert($data);

	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('category');
	                }

		        }else{
		        	if ($this->upload->do_upload('fileinput2')) {
	                    $image = $this->upload->data();
	                   	$data= array(
			        		'type'=>post('type'),
			        		'type_banner_image'=>$image['file_name']
			        	);	
			        	$ret = $this->category->insert($data);
	                }else{
	                	$this->session->set_flashdata('error',$this->upload->display_errors());
	                 	redirect('category');
	                }
		        }
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Category added',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);
	        		$this->session->set_flashdata('success','category Added');
	        		redirect('category');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('category');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('category');
	    }

	}
	// udate category method
	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'type', 'required');
		if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('category');
	        }else{
	        	$image = '';
	            $upload_path =  $this->config->item('upload_path').'/category';

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
			        		'type'=>post('type'),
			        		'category_image_url'=>$image['file_name']
			        	);
			        	$where = array('mt_id'=>post('mt_id'));	
			        	$ret = $this->category->update($data,$where );
	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('category');
	                }

		        }elseif ($this->upload->do_upload('fileinput2')) {
		        	if ($this->upload->do_upload('fileinput2')) {
	                    $image = $this->upload->data();
	                   
	                   	$data= array(
			        		'type'=>post('type'),
			        		'type_banner_image'=>$image['file_name']
			        	);
			        	$where = array('mt_id'=>post('mt_id'));	
			        	$ret = $this->category->update($data,$where );
	                } else {
	                  $this->session->set_flashdata('error',$this->upload->display_errors());
	                  redirect('category');
	                }
		        }elseif ($this->upload->do_upload('fileinput') && $this->upload->do_upload('fileinput2') ) {
		        	if($this->upload->do_upload('fileinput')){
	                	$image = $this->upload->data();
		    			if ($this->upload->do_upload('fileinput2') ) {
		                    
		                   	$image2 = $this->upload->data();

		                   	$data= array(
				        		'type'=>post('type'),
				        		'category_image_url'=>$image['file_name'],
				        		'type_banner_image'=>$image2['file_name']
				        	);	
				        	$where = array('mt_id'=>post('mt_id'));	
			        		$ret = $this->category->update($data,$where );
		                } else {
		                  $this->session->set_flashdata('error',$this->upload->display_errors());
		                  redirect('category');
		                }
	            	}

		        }else{
	        		$data= array(
		        		'type'=>post('type'),
		        	);
		        	$where = array('mt_id'=>post('mt_id'));		
		        	$ret = $this->category->update($data,$where );

		        }
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Category Updated',
	        			'data'=>json_encode($data)
	        		);
	        		$this->db->insert('user_activity',$dataActivity);
	        		$this->session->set_flashdata('success','Category Updated');
	        		redirect('category');
	        	}else{

		        	$this->session->set_flashdata('error','Error in update');
		            redirect('category');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('category');
	    }
	}
	// json method to get category data
	function getcategory(){
		$id = post('id');
		$ret =  $this->category->getcategorybyid($id);
		echo  json_encode($ret);
		exit;
	}
	//Ajax	 search method 
	public function search(){

		$data = array();
		$data["categorys"] = $this->category->fetch_data_bysearch();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/search')) {
			$this->load->view('themes/' . $theme . '/template/category/search', $data);
		} else {
			$this->load->view('themes/default/template/category/search', $data);
			
		}
	}
	// multiple delete method
	function deletemultiple(){
		if(checkModification()){
			foreach ($this->input->post('delete') as $u) {
				$ret =  $this->category->delete($u);
			}
			if($ret){
				$this->session->set_flashdata('success','Deleted Successfully  ');
				echo json_encode($ret);
			}else{
				$this->session->set_flashdata('error','Item Currently being used');
				echo json_encode($ret);
			}
		}else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	      	 echo json_encode('0');
	    }
		
	}
}	

/* End of file category.php */
/* Location: ./application/controllers/category.php */