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
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/categories/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->categories->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['cate'] = $this->input->get('category');
		$data["categories"] = $this->categories->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/index')) {
			$this->load->view('themes/' . $theme . '/template/category/index', $data);
		} else {
			$this->load->view('themes/default/template/category/index', $data);

		}
	}
	// add categories form page
	public function addcategories() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		$data['category_par'] = $this->categories->getCategory();
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/add')) {
			$this->load->view('themes/' . $theme . '/template/category/add', $data);
		} else {
			$this->load->view('themes/default/template/category/add', $data);

		}

	}
	// edit categories form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('categories');
		}
		$data = array();
		$data['categories'] = $this->categories->getcategoryByid($id);
		$data['category_par'] = $this->categories->getCategory();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/category/edit')) {
			$this->load->view('themes/' . $theme . '/template/category/edit', $data);
		} else {
			$this->load->view('themes/default/template/category/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categories_name', 'categories name', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('categories/addcategories');
			} else {
				$data = array(
					'category' => post('categories_name'),
					'parent_category'=>post('parent_category'),
					'enabled' => post('enabled'),
					'created_on	' => date('Y-m-d'),
				);

				$ret = $this->categories->insert($data);
				addactivty('categories Added');
				$this->session->set_flashdata('success', 'Categories Added');
				redirect('categories/addcategories');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('categories/addcategories');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categories_name', 'categories name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('categories/edit/' . post('categories_id') . '');
			} else {
				$data = array(
					'category' => post('categories_name'),
					'parent_category'=>post('parent_category'),
					'enabled' => post('enabled'),
					'created_on	' => date('Y-m-d'),
				);

				$where = array('cat_id' => post('cat_id'));
				$ret = $this->categories->update($data, $where);
				addactivty('categories Updated');
				$this->session->set_flashdata('success', 'Categories Updated');
				redirect('categories/edit/' . post('categories_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('categories/addcategories');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->categories->delete($u);
			addactivty('categories Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Categories.php */
/* categories: ./application/controllers/Categories.php */