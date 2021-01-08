<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('groups_models', 'groups');
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
		
		$base_url = "/groups/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->groups->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('groups');
		$data["groups"] = $this->groups->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/groups/index')) {
			$this->load->view('themes/' . $theme . '/template/groups/index', $data);
		} else {
			$this->load->view('themes/default/template/groups/index', $data);

		}
	}
	// add groups form page
	public function addgroups() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/groups/add')) {
			$this->load->view('themes/' . $theme . '/template/groups/add', $data);
		} else {
			$this->load->view('themes/default/template/groups/add', $data);

		}

	}
	// edit groups form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('groups');
		}
		$data = array();
		$data['groups'] = $this->groups->getgroupsByid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/groups/edit')) {
			$this->load->view('themes/' . $theme . '/template/groups/edit', $data);
		} else {
			$this->load->view('themes/default/template/groups/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('groups_name', 'groups name', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('groups/addgroups');
			} else {
				$data = array(
					'group_name' => post('groups_name'),
					'enabled' => post('enabled'),
				);

				$ret = $this->groups->insert($data);
				addactivty('Groups Added');
				$this->session->set_flashdata('success', 'Groups Added');
				redirect('groups/addgroups');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('groups/addgroups');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('groups_name', 'groups name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('groups/edit/' . post('ag_id') . '');
			} else {
				$data = array(
					'group_name' => post('groups_name'),
					'enabled' => post('enabled'),
				);

				$where = array('ag_id' => post('ag_id'));
				$ret = $this->groups->update($data, $where);
				addactivty('groups Updated');
				$this->session->set_flashdata('success', 'Groups Updated');
				redirect('groups/edit/' . post('ag_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('groups/addgroups');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->groups->delete($u);
			addactivty('Groups Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Groups.php */
/* groups: ./application/controllers/Groups.php */