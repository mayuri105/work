<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('area_models', 'area');
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
		
		$base_url = "/area/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->area->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('area');
		//$data['city'] = $this->area->getCity();
		$data["area"] = $this->area->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/area/index')) {
			$this->load->view('themes/' . $theme . '/template/area/index', $data);
		} else {
			$this->load->view('themes/default/template/area/index', $data);

		}
	}
	// add area form page
	public function addarea() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		//$data['city'] = $this->area->getCity();
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/area/add')) {
			$this->load->view('themes/' . $theme . '/template/area/add', $data);
		} else {
			$this->load->view('themes/default/template/area/add', $data);

		}

	}
	// edit area form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('area');
		}
		$data = array();
		$data['area'] = $this->area->getareaByid($id);
		//$data['city'] = $this->area->getCity();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/area/edit')) {
			$this->load->view('themes/' . $theme . '/template/area/edit', $data);
		} else {
			$this->load->view('themes/default/template/area/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('area_name', 'area name', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('area/addarea');
			} else {
				$data = array(
					'area_name' => post('area_name'),
					
					'enabled' => post('enabled'),
					'added_date	' => date('Y-m-d'),
				);

				$ret = $this->area->insert($data);
				addactivty('area Added');
				$this->session->set_flashdata('success', 'Area Added');
				redirect('area/addarea');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('area/addarea');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('area_name', 'area name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('area/edit/' . post('area_id') . '');
			} else {
				$data = array(
					'area_name' => post('area_name'),
					'enabled' => post('enabled'),
					'added_date	' => date('Y-m-d'),
				);

				$where = array('area_id' => post('area_id'));
				$ret = $this->area->update($data, $where);
				addactivty('area Updated');
				$this->session->set_flashdata('success', 'Area Updated');
				redirect('area/edit/' . post('area_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('area/addarea');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->area->delete($u);
			addactivty('area Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Area.php */
/* area: ./application/controllers/Area.php */