<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller {

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
		$base_url = "/pages/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
        
		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->page->record_count());
        $data["pagination_helper"]   = $this->pagination;
        $data["pages"] = $this->page->fetch_data($perpage ,(($page-1) * $perpage));
        $theme = $this->session->userdata('admin_theme');
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
		$theme = $this->session->userdata('admin_theme');
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
		$data['page'] = $this->page->get($id);
        
		$theme = $this->session->userdata('admin_theme');
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
       
        $this->form_validation->set_rules('meta_keywords','meta_keywords', '');
        $this->form_validation->set_rules('meta_description','meta_description', '');

       
	        if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('error', validation_errors());
	            redirect('pages/add');
	        }else{
	        	
			
				
	            $upload_path =  $this->config->item('upload_path').'/pages';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);

	        	if ($this->upload->do_upload('fileinput')) {
	        		$mid = $this->session->userdata('m_id');
	        		$shopdata= $this->page->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
	        	$page_uniquename = $this->generatUnique(post('alias'),$shop_id);
	        	
                    $image = $this->upload->data();
                   	$data= array(
		        		'title'=>post('title'),
	        		'content'=>post('content'),
	        		'show_on_footer'=>post('show_on_footer'),
	        		'meta_keywords'=>post('meta_keywords'),
	        		'meta_description'=>post('meta_description'),
	        		'unique_alias'=>$page_uniquename,
		        		'shop_id'=>$shop_id,
		        		'page_image'=>$image['file_name'],
		        		
		        	);	
		        	$ret = $this->page->insert($data);
		        	$this->session->set_flashdata('success','Page Added');
	        		redirect('pages');
                }else{
                	$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('pages');
                }
	        	
	        }
	        	
	        	

	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
       
        $this->form_validation->set_rules('meta_keywords','meta_keywords', '');
        $this->form_validation->set_rules('meta_description','meta_description', '');
		
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('pages/edit/' . post('p_id') . '');
			} else {
				
				
				$upload_path =  $this->config->item('upload_path').'/pages';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
				$mid = $this->session->userdata('m_id');
				$shopdata= $this->page->getshopbymer($mid);
				$shop_id = $shopdata->shop_id;
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('fileinput')) {
                    $image = $this->upload->data();
                  	$data= array(
		        		'title'=>post('title'),
	        		'content'=>post('content'),
	        		'show_on_footer'=>post('show_on_footer'),
	        		'meta_keywords'=>post('meta_keywords'),
	        		'meta_description'=>post('meta_description'),
	        		'created_on'=>date('Y-m-d H:i:s'),
	        		'unique_alias'=>$page_uniquename,
		        		'shop_id'=>$shop_id,
		        		'page_image'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('p_id'=>post('p_id'));
		        	$ret = $this->page->update($data,$where);
		        	$this->session->set_flashdata('success', 'Page Updated');
					redirect('pages');
                }else{
                	$data= array(
		        		'title'=>post('title'),
	        		'content'=>post('content'),
	        		'show_on_footer'=>post('show_on_footer'),
	        		'meta_keywords'=>post('meta_keywords'),
	        		'meta_description'=>post('meta_description'),
	        		'created_on'=>date('Y-m-d H:i:s'),
	        		'unique_alias'=>$page_uniquename,
		        		'shop_id'=>$shop_id,
		        				        		
		        	);	
		        	$where = array('p_id'=>post('p_id'));
		        	$ret = $this->page->update($data,$where);
                	
                	$this->session->set_flashdata('success', 'Page Updated');
					redirect('pages');
                }
				
			}
		
	}
function pagestatus($id){

	

			

			$ret = $this->page->pageupdatestatus($id);

			$this->output->set_content_type('application/json')->set_output(json_encode($ret));

			$this->session->set_flashdata('success', 'Update Successfully  ');

		}

		function pagedelete($id) {



	$ret=$this->page->pagedelete($id);

	$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	$this->session->set_flashdata('success', 'Deleted Successfully  ');

	}
	
	function generatUnique($string,$id='',$shop_id){
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
			while($this->page_exist($last,$id,$shop_id)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return $mainstring;		
		}
	
	}
	public function page_exist($store,$id='',$shop_id){
		if ($id) {
			$this->db->where('p_id !=',$id);
		}
		if ($shop_id) {
			$this->db->where('shop_id !=',$shop_id);
		}
		$this->db->where('unique_alias',$store);
		$ret = $this->db->get('shop_page');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */