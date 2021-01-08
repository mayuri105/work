<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_model', 'page');
		$this->load->library('pagination');
		$this->load->library('paginationlib');	
		$this->load->helper('form');
	}
	// main page
	public function index()
	{
		
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/page/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->page->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["pages"] = $this->page->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/index')) {
			$this->load->view('themes/' . $theme . '/template/page/index', $data);
		} else {
			$this->load->view('themes/default/template/page/index', $data);
			
		}

	}
	// add page 
	public function add()
	{
		
		$data = array();
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/add')) {
			$this->load->view('themes/' . $theme . '/template/page/add', $data);
		} else {
			$this->load->view('themes/default/template/page/add', $data);
			
		}

	}
	// edit page 
	public function edit($id='')
	{
		if($id=='') redirect('page');
		
		$data = array();
		$data['pages'] = $this->page->get($id);
        
		$theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/edit')) {
			$this->load->view('themes/' . $theme . '/template/page/edit', $data);
		} else {
			$this->load->view('themes/default/template/page/edit', $data);
			
		}

	}
	
	public function addpage(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('alias','alias','required');
        $this->form_validation->set_rules('meta_keywords','meta_keywords', '');
        $this->form_validation->set_rules('meta_description','meta_description', '');

        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('page/add');
	        }else{

	        	
	        	$page_uniquename = $this->generatUnique(post('alias'));
	        	$data= array(
	        		'title'=>post('title'),
	        		'content'=>post('content'),
	        		'show_on_footer'=>post('show_on_footer'),
	        		'meta_keywords'=>post('meta_keywords'),
	        		'meta_description'=>post('meta_description'),
	        		'created_on'=>date('Y-m-d H:i:s'),
	        		'unique_alias'=>$page_uniquename
	        	);	

	        	$ret = $this->page->insert($data);
	        	

	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Page Added',
		        		'data'=>json_encode($data)
		        	);
	        		$this->db->insert('user_activity',$dataActivity);
	        		

	        		$this->session->set_flashdata('success','Page Created');
	        		redirect('page/add');
	        	}else{

		        	$this->session->set_flashdata('error','Error In insert');
		            redirect('page/add');
		        }
	        }
	    }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('page');
	    }

	}

	public function update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('alias','alias','required');
        $this->form_validation->set_rules('meta_keywords','meta_keywords', '');
        $this->form_validation->set_rules('meta_description','meta_description', '');

        if(checkModification()){
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('page');
	        }else{
	        	$page_uniquename = $this->generatUnique(post('alias'),post('p_id'));
	        	$data= array(
	        		'title'=>post('title'),
	        		'content'=>post('content'),
	        		'show_on_footer'=>post('show_on_footer'),
	        		'meta_keywords'=>post('meta_keywords'),
	        		'meta_description'=>post('meta_description'),
	        		'unique_alias'=>$page_uniquename 
	        	);	
	        	$where = array('p_id'=>post('p_id'));
	        	$ret = $this->page->update($data,$where);
	        	
	        	if($ret){
	        		$dataActivity = array(
	        			'user_id'=>$this->session->u_id,
	        			'act_key'=>'Page Updated',
		        		'data'=>json_encode($data)
		        	);
	        		$this->db->insert('user_activity',$dataActivity);
	        		
	        		$this->session->set_flashdata('success','Page Updated');
	        		redirect('page');
	        	}else{
		        	$this->session->set_flashdata('error','Error In Update');
		            redirect('page');
		        }
	        }
        }else{
	    	$this->session->set_flashdata('warnings','You do not have permission to modify');
	        redirect('page');
	    }


	}
	function delete($id){
		if($id=='') redirect('page');
		if (checkModification()) {
			$ret =  $this->page->delete($id);
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
		$data["pages"] = $this->page->fetch_data_bysearch();
        $theme = $this->session->userdata('theme');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/search')) {
			$this->load->view('themes/' . $theme . '/template/page/search', $data);
		} else {
			$this->load->view('themes/default/template/page/search', $data);
			
		}
	}
	function generatUnique($string,$id=''){
		$slug =strtolower($string);

		$slugrpc = str_replace(' ','-', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->page_exist($last)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return $mainstring;	
		}else{
			while($this->page_exist($last,$id)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return $mainstring;		
		}
	
	}
	public function page_exist($store,$id=''){
		if ($id) {
			$this->db->where('p_id !=',$id);
		}
		$this->db->where('unique_alias',$store);
		$ret = $this->db->get('page');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */