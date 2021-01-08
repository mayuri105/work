<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('scheduler_models', 'scheduler');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		$perpage = $this->setting->get('per_page');
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['open_day'] = $this->setting->get('open_day');
		$data['timeslot'] = $this->scheduler->fetch_data();
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/scheduler/index')) {
			$this->load->view('themes/' . $theme . '/template/scheduler/index', $data);
		} else {
			$this->load->view('themes/default/template/scheduler/index', $data);

		}
	}
	public function saveDayOption() {
		if (checkModification()) {
			$this->setting->update('open_day', implode(',',post('open_day')));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('scheduler/index');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('scheduler/index');
		}
	}
	

	public function addtimeslot() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('start_time', 'start_time', 'required');
		$this->form_validation->set_rules('end_time', 'end_time', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('scheduler/index');
			} else {
				$data = array(
					'start_time'=>date('H:i:s',strtotime( post('start_time'))),
					'end_time'	=>date('H:i:s',strtotime( post('end_time'))),
					'enabled' 	=>post('enabled'),
				);
				$ret = $this->scheduler->insert($data);
				$this->session->set_flashdata('success', 'Timeslot Added');
				redirect('scheduler/index');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('scheduler/index');
		}
	}

	public function gettimesechudle(){
		$id = $this->input->get('id');
		$return = $this->scheduler->getTimeSlot($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($return));

	}


	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('enabled', 'enabled', 'required');
		//$this->form_validation->set_rules('end_time', 'end_time', 'required');
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('scheduler/index');
			} else {
				$data = array(
					// 'start_time'=>date('H:i:s',strtotime( post('start_time'))),
					// 'end_time'	=>date('H:i:s',strtotime( post('end_time'))),
					'enabled' 	=>post('enabled'),
				);
				$where = array('ts_id' => post('ts_id'));
				$ret = $this->scheduler->update($data, $where);
				$this->session->set_flashdata('success', 'Timeslot Updated');
				redirect('scheduler/index');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('scheduler/index');
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