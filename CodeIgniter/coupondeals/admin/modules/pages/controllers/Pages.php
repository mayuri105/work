<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pages_models', 'pages');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		
		
		$data = array();
		$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/pages/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->pages->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["pages"] = $this->pages->fetch_data($perpage, (($page - 1) * $perpage));
		$data['pages_par'] = $this->pages->getpage();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/index')) {
			$this->load->view('themes/' . $theme . '/template/pages/index', $data);
		} else {
			$this->load->view('themes/default/template/pages/index', $data);

		}
	}
	// add categories form page
	public function addpage() {
		$data = array();
		
		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/add')) {
			$this->load->view('themes/' . $theme . '/template/pages/add', $data);
		} else {
			$this->load->view('themes/default/template/pages/add', $data);

		}

	}
	
	public function edit($id = '') {
		if ('' == $id) {
			redirect('pages');
		}
		$data = array();
		$data['pages'] = $this->pages->getpageByid($id);
		$data['pages_par'] = $this->pages->getpage();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/edit')) {
			$this->load->view('themes/' . $theme . '/template/pages/edit', $data);
		} else {
			$this->load->view('themes/default/template/pages/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', ' Description', 'required');
	
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('pages/addpage/');
			} else {
		
			
				$data = array(
					'name' => post('name'),
					'page_slug' =>$this->generatUnique(post('name')),
					'description'=>post('description'),
					
					
				);

				$ret = $this->pages->insert($data);
				
				$upload_path =  $this->config->item('upload_path').'/pagesimages';

	           if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('img_name')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'img_name'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('page_id'=>$ret);
		        	$ret = $this->pages->updateimages($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('pages');


			}
		
	}

	public function updatepage() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('pages/edit/' . post('page_id') . '');
			} else {
				$data = $this->input->post();
				$id  = $data['page_id'];
				$this->pages->update($data);
				
	        	$upload_path =  $this->config->item('upload_path').'/pagesimages';

	            if (!file_exists($upload_path)) {
				    mkdir($upload_path, 0777, true);
				}
	            $c_upload['upload_path']    =  $upload_path;
	            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
	            $this->load->library('upload', $c_upload);
	        	if ($this->upload->do_upload('img_name')) {
                    $image = $this->upload->data();
                   	$data2= array(
		        		'img_name'=>$image['file_name'],
		        		
		        	);	
		        	$where = array('page_id'=>$id);
		        	$ret = $this->pages->updateimages($data2,$where);
		        	
                }
	           
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('pages');

			}
		
	}
			
	function delete($id) {

	$ret=$this->pages->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}

	
function generatUnique($string,$id=''){
		$this->load->helper('url');
		$string2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
		$slug =strtolower($string2);
		$slugrpc = str_replace(' ','-', $slug); // Replaces all spaces with hyphens.

		$last = preg_replace('/[^A-Za-z0-9\-]/',' ', $slugrpc); 
		$i = 1; $baseSlug = $last;

		if ($id=='') {
			while($this->exitcheck($last)){
				$last = $baseSlug.'-'.$i++;        
			}

			$mainstring =  $last;
			return url_title($mainstring);	
		}else{
			while($this->exitcheck($last,$id)){
				$last = $baseSlug.'-'.$i++;        
			}
			$mainstring =  $last;
			return url_title($mainstring);		
		}
	
	}
	public function exitcheck($page,$id=''){
		if ($id) {
			$this->db->where('id !=',$id);
		}
		$this->db->where('page_slug',$page);
		$ret = $this->db->get('tbl_pages');
		$this->db->where('blog_slug',$page);
		$ret = $this->db->get('tbl_blogs');
		$this->db->where('deal_slug',$page);
		$ret = $this->db->get('tbl_product_deal');

		if($ret->row()){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */