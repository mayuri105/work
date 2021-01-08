<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package_category extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('package_category_models', 'package_category');
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
		
		$base_url = "/package_category/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->package_category->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('package_category');
		
		$data["package_category"] = $this->package_category->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package_category/index')) {
			$this->load->view('themes/' . $theme . '/template/package_category/index', $data);
		} else {
			$this->load->view('themes/default/template/package_category/index', $data);

		}
	}
	// add package_category form page
	public function addpackage_category() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package_category/add')) {
			$this->load->view('themes/' . $theme . '/template/package_category/add', $data);
		} else {
			$this->load->view('themes/default/template/package_category/add', $data);

		}

	}
	// edit package_category form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('package_category');
		}
		$data = array();
		$data['package_category'] = $this->package_category->getpackage_categoryByid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package_category/edit')) {
			$this->load->view('themes/' . $theme . '/template/package_category/edit', $data);
		} else {
			$this->load->view('themes/default/template/package_category/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_category_name', 'package_category name', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('package_category/addpackage_category');
			} else {
				$data = array(
					'package_category_name' => post('package_category_name'),
					'extend_days_for_same_package'=>post('extend_days_for_same_package')
					
				);

				$ret = $this->package_category->insert($data);
				addactivty('package_category Added');
				$this->session->set_flashdata('success', 'Package_category Added');
				redirect('package_category/addpackage_category');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('package_category/addpackage_category');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_category_name', 'package_category name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('package_category/edit/' . post('package_category_id') . '');
			} else {
				$data = array(
					'package_category_name' => post('package_category_name'),
					'extend_days_for_same_package'=>post('extend_days_for_same_package')
				);

				$where = array('package_category_id' => post('package_category_id'));
				$ret = $this->package_category->update($data, $where);
				addactivty('package_category Updated');
				$this->session->set_flashdata('success', 'Package_category Updated');
				redirect('package_category/edit/' . post('package_category_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('package_category/addpackage_category');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->package_category->delete($u);
			addactivty('package_category Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Package_category.php */
/* package_category: ./application/controllers/Package_category.php */