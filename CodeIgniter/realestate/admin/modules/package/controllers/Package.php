<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('package_models', 'package');
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
		
		$base_url = "/package/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->package->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('package');
		$data["package"] = $this->package->fetch_data($perpage, (($page - 1) * $perpage));

		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/index')) {
			$this->load->view('themes/' . $theme . '/template/package/index', $data);
		} else {
			$this->load->view('themes/default/template/package/index', $data);

		}
	}
	// add package form page
	public function addpackage() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		$data['package_category'] = $this->package->getPackageCategory();
		//load view

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/add')) {
			$this->load->view('themes/' . $theme . '/template/package/add', $data);
		} else {
			$this->load->view('themes/default/template/package/add', $data);

		}

	}
	// edit package form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('package');
		}
		$data = array();
		$data['package'] = $this->package->getpackageByid($id);
		$data['package_category'] = $this->package->getPackageCategory();
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/package/edit')) {
			$this->load->view('themes/' . $theme . '/template/package/edit', $data);
		} else {
			$this->load->view('themes/default/template/package/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_name', 'package name', 'required');
		$this->form_validation->set_rules('package_price', 'package price', 'required|is_numeric');
		$this->form_validation->set_rules('package_periods', 'package periods', 'required|is_numeric');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('package/addpackage');
			} else {
				$data = array(
					'package_name' => post('package_name'),
					'package_price'=>post('package_price'),
					'package_periods' => post('package_periods'),
					'package_category_id' => post('package_category_id'),
					
					'added_date'=>date('Y-m-d')
				);

				$ret = $this->package->insert($data);
				addactivty('Package Added');
				$this->session->set_flashdata('success', 'Package Added');
				redirect('package/addpackage');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('package/addpackage');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('package_name', 'package name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('package/edit/' . post('package_id') . '');
			} else {
				$data = array(
					'package_name' => post('package_name'),
					'package_price'=>post('package_price'),
					'package_periods' => post('package_periods'),
					'package_category_id' => post('package_category_id'),
					
				);

				$where = array('package_id' => post('package_id'));
				$ret = $this->package->update($data, $where);
				addactivty('package Updated');
				$this->session->set_flashdata('success', 'Package Updated');
				redirect('package/edit/' . post('package_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('package/addpackage');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->package->delete($u);
			addactivty('Package Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file .php */
/* package: ./application/controllers/Package.php */