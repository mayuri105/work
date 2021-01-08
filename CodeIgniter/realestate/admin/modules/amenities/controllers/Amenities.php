<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amenities extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('amenities_models', 'amenities');
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
		
		$base_url = "/amenities/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->amenities->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('amenities');
		$data["amenities"] = $this->amenities->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amenities/index')) {
			$this->load->view('themes/' . $theme . '/template/amenities/index', $data);
		} else {
			$this->load->view('themes/default/template/amenities/index', $data);

		}
	}
	// add amenities form page
	public function addamenities() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amenities/add')) {
			$this->load->view('themes/' . $theme . '/template/amenities/add', $data);
		} else {
			$this->load->view('themes/default/template/amenities/add', $data);

		}

	}
	// edit amenities form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('amenities');
		}
		$data = array();
		$data['amenities'] = $this->amenities->getamenitiesByid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/amenities/edit')) {
			$this->load->view('themes/' . $theme . '/template/amenities/edit', $data);
		} else {
			$this->load->view('themes/default/template/amenities/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('amenities_name', 'amenities name', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('amenities/addamenities');
			} else {
				$data = array(
					'amenity_name' => post('amenities_name'),
					'amenity_icon'=>post('amenities_icon'),
					'enabled' => post('enabled'),
					
				);

				$ret = $this->amenities->insert($data);
				addactivty('Amenities Added');
				$this->session->set_flashdata('success', 'Amenites Added');
				redirect('amenities/addamenities');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('amenities/addamenities');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('amenities_name', 'amenities name', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('amenities/edit/' . post('amenities_id') . '');
			} else {
				$data = array(
					'amenity_name' => post('amenities_name'),
					'amenity_icon'=>post('amenities_icon'),
					'enabled' => post('enabled'),
				);

				$where = array('amenities_id' => post('amenities_id'));
				$ret = $this->amenities->update($data, $where);
				addactivty('amenities Updated');
				$this->session->set_flashdata('success', 'Amenites Updated');
				redirect('amenities/edit/' . post('amenities_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('amenities/addamenities');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->amenities->delete($u);
			addactivty('amenities Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Amenites.php */
/* amenities: ./application/controllers/Amenites.php */