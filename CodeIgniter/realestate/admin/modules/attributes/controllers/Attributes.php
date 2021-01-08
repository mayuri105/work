<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attributes extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('attributes_models', 'attributes');
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
		
		$base_url = "/attributes/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->attributes->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('attributes');
		$data["attributes"] = $this->attributes->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/attributes/index')) {
			$this->load->view('themes/' . $theme . '/template/attributes/index', $data);
		} else {
			$this->load->view('themes/default/template/attributes/index', $data);

		}
	}
	// add attributes form page
	public function addattributes() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		$data['groups'] = $this->attributes->getGroups();
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/attributes/add')) {
			$this->load->view('themes/' . $theme . '/template/attributes/add', $data);
		} else {
			$this->load->view('themes/default/template/attributes/add', $data);

		}

	}
	// edit attributes form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('attributes');
		}
		$data = array();
		$data['attributes'] = $this->attributes->getattributesByid($id);
		$data['groups'] = $this->attributes->getGroups();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/attributes/edit')) {
			$this->load->view('themes/' . $theme . '/template/attributes/edit', $data);
		} else {
			$this->load->view('themes/default/template/attributes/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('attributes_name', 'Attributes name', 'required');
		$this->form_validation->set_rules('attributes_group_id','Attributes group ','required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('attributes/addattributes');
			} else {
				$data = array(
					'attributes_name' => post('attributes_name'),
					'attributes_group_id' => post('attributes_group_id'),
				);

				$ret = $this->attributes->insert($data);
				addactivty('attributes Added');
				$this->session->set_flashdata('success', 'Attributes Added');
				redirect('attributes/addattributes');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('attributes/addattributes');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('attributes_name', 'attributes name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('attributes/edit/' . post('sa_id') . '');
			} else {
				$data = array(
					'attributes_name' => post('attributes_name'),
					'attributes_group_id' => post('attributes_group_id'),
				);

				$where = array('sa_id' => post('sa_id'));
				$ret = $this->attributes->update($data, $where);
				addactivty('attributes Updated');
				$this->session->set_flashdata('success', 'Attributes Updated');
				redirect('attributes/edit/' . post('sa_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('attributes/addattributes');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->attributes->delete($u);
			addactivty('attributes Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Attributes.php */
/* attributes: ./application/controllers/Attributes.php */