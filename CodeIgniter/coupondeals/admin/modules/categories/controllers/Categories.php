<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('categories_models', 'categories');
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
		
		$base_url = "/categories/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url,$perpage,$this->categories->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["categories"] = $this->categories->fetch_data($perpage, (($page - 1) * $perpage));
		$data['categories_par'] = $this->categories->getcategory();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/index')) {
			$this->load->view('themes/' . $theme . '/template/category/index', $data);
		} else {
			$this->load->view('themes/default/template/category/index', $data);

		}
	}
	public function addcat() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/add')) {
			$this->load->view('themes/' . $theme . '/template/category/add', $data);
		} else {
			$this->load->view('themes/default/template/category/add', $data);

		}

	}

	//edit
	public function edit($id = '') {
		if ('' == $id) {
			redirect('categories');
		}
		$data = array();
		$data['categories'] = $this->categories->getcategoryByid($id);
		$data['categories_par'] = $this->categories->getCategory();
		
		$theme = $this->session->userdata('admin_theme');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/edit')) {
			$this->load->view('themes/' . $theme . '/template/category/edit', $data);
		} else {
			$this->load->view('themes/default/template/category/edit', $data);

		}
	}
//add category
	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_name', 'name', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('categories/addcat');
			} else {
				$data = array(
					'cat_name' => post('cat_name'),
					

				);

				$ret = $this->categories->insert($data);
				
				$this->session->set_flashdata('success', 'Categories Added');
				redirect('categories');
				
		}
			
		
	}
//update
	public function updatecat() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_name', 'name', 'required');
		
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('categories/edit/'. post('cat_id') . '');
			} else {
				$data = array(
					'cat_name' => post('cat_name'),
					
               );
				$where = array('cat_id' => post('cat_id'));
				$ret = $this->categories->update($data, $where);
				
				$this->session->set_flashdata('success', 'Categories Updated');
				redirect('categories');
			}
		
	}

	function delete($id) {

	$ret=$this->categories->delete($id);
	$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	$this->session->set_flashdata('success', 'Deleted Successfully  ');
	}

	
		
}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */