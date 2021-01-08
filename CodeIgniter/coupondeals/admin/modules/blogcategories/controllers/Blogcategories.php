<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogcategories extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('blogcategories_models', 'blogcategories');
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
		
		$base_url = "/blogcategories/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->blogcategories->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["blogcategories"] = $this->blogcategories->fetch_data($perpage, (($page - 1) * $perpage));
		$data['blogcategories_par'] = $this->blogcategories->getcategory();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blogcategory/index')) {
			$this->load->view('themes/' . $theme . '/template/blogcategory/index', $data);
		} else {
			$this->load->view('themes/default/template/blogcategory/index', $data);

		}
	}
	public function addblogcat() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blogcategory/add')) {
			$this->load->view('themes/' . $theme . '/template/blogcategory/add', $data);
		} else {
			$this->load->view('themes/default/template/blogcategory/add', $data);

		}

	}

	//edit
	public function edit($id = '') {
		if ('' == $id) {
			redirect('blogcategories');
		}
		$data = array();
		$data['blogcategories'] = $this->blogcategories->getcategoryByid($id);
		$data['blogcategories_par'] = $this->blogcategories->getCategory();
		
		$theme = $this->session->userdata('admin_theme');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/blogcategory/edit')) {
			$this->load->view('themes/' . $theme . '/template/blogcategory/edit', $data);
		} else {
			$this->load->view('themes/default/template/blogcategory/edit', $data);

		}
	}
//add category
	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('blog_cat_name', 'name', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('categories/addcat');
			} else {
				$data = array(
					'blog_cat_name' => post('blog_cat_name'),
					'blog_cat_slug' =>$this->generatUnique(post('blog_cat_name')),

				);

				$ret = $this->blogcategories->insert($data);
				
				$this->session->set_flashdata('success', 'Categories Added');
				redirect('blogcategories');
				
		}
			
		
	}
//update
	public function updatecat() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('blog_cat_name', 'name', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('blogcategories/edit/'. post('blog_cat_id') . '');
			} else {
				$data = array(
					'blog_cat_name' => post('blog_cat_name'),
					
               );
				$where = array('blog_cat_id' => post('blog_cat_id'));
				$ret = $this->blogcategories->update($data, $where);
				
				$this->session->set_flashdata('success', 'Categories Updated');
				redirect('blogcategories');
			}
		
	}

	function delete($id) {

	$ret=$this->blogcategories->delete($id);
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
	public function exitcheck($blog,$id=''){
		if ($id) {
			$this->db->where('blog_cat_id !=',$id);
		}
		$this->db->where('blog_cat_slug',$blog);
		$ret = $this->db->get('tbl_blog_categories');
		$this->db->where('blog_slug',$blog);
		$ret = $this->db->get('tbl_blogs');
		$this->db->where('deal_slug',$blog);
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