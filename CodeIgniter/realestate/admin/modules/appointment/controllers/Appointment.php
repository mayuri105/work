<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('appointment_models', 'appointment');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->helper('form');
		$this->load->helper('url');

	}

	public function index(){
		$perpage = $this->setting->get('per_page');
		$data = array();
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		
		$base_url = "/appointment/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->appointment->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['appointment_status'] = $this->input->get('appointment_status');
		$data['customer'] = $this->input->get('customer');
		$data['date_added'] = $this->input->get('date_added');
			
		$data["appointment"] = $this->appointment->fetch_data($perpage, (($page - 1) * $perpage));
		$data['appstatus'] = $this->appointment->getAppointmentSta();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/index')) {
			$this->load->view('themes/' . $theme . '/template/appointment/index', $data);
		} else {
			$this->load->view('themes/default/template/appointment/index', $data);

		}
	}
	// add appointment form page
	public function addappointment() {
		$data = array();
		
		$data['cust'] = $this->appointment->getCust();
		$data['appstatus'] = $this->appointment->getAppointmentSta();
		$open_day  = $this->setting->get('open_day');
		$data['open_day'] = explode(',', $open_day);	
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/add')) {
			$this->load->view('themes/' . $theme . '/template/appointment/add', $data);
		} else {
			$this->load->view('themes/default/template/appointment/add', $data);

		}

	}
	// edit appointment form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('appointment');
		}
		$data = array();
		$data['appointment'] = $this->appointment->getappointmentByid($id);
		$data['cust'] = $this->appointment->getCust();
		$data['appstatus'] = $this->appointment->getAppointmentSta();
		$open_day  = $this->setting->get('open_day');
		
		$data['open_day'] = explode(',', $open_day);	
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/edit')) {
			$this->load->view('themes/' . $theme . '/template/appointment/edit', $data);
		} else {
			$this->load->view('themes/default/template/appointment/edit', $data);

		}
	}

	public function add() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('appointment_date', 'Appointment_date', 'required');
		$this->form_validation->set_rules('appointment_time', 'Appointment time', 'required');
		$this->form_validation->set_rules('appointment_status', 'Appointment status', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$data['cust'] = $this->appointment->getCust();
				$data['appstatus'] = $this->appointment->getAppointmentSta();
				
				$theme = $this->session->userdata('admin_theme');
				//load view
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/appointment/add')) {
					$this->load->view('themes/' . $theme . '/template/appointment/add', $data);
				} else {
					$this->load->view('themes/default/template/appointment/add', $data);
				}
			} else {

				
				
				$data = array(
					'customer_id' => post('customer'),
					'appointment_for'=>post('appointment_for'),
					'property_id'=>post('property_id'),
					'appointment_date' => date('Y-m-d',strtotime(post('appointment_date'))),
					'appointment_time'=>post('appointment_time'),
					'appointment_status' => post('appointment_status'),
					'appointment_note'=>post('appointment_note'),
					'added_date'=>date('Y-m-d'),
				);

				$ret = $this->appointment->insert($data);
				addactivty('Appointment Added');
				$this->session->set_flashdata('success', 'Appointment Added');
				redirect('appointment/addappointment');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('appointment/addappointment');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('appointment_date', 'Appointment_date', 'required');
		$this->form_validation->set_rules('appointment_time', 'Appointment time', 'required');
		$this->form_validation->set_rules('appointment_status', 'Appointment status', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('appointment/edit/' . post('appointment_id') . '');
			} else {
				
				$data = array(
					'customer_id' => post('customer'),
					'appointment_date' => date('Y-m-d',strtotime(post('appointment_date'))),
					'property_id'=>post('property_id'),
					'appointment_time'=>post('appointment_time'),
					'appointment_status' => post('appointment_status'),
					'appointment_note'=>post('appointment_note'),
					
				);

				$where = array('appointment_id' => post('appointment_id'));
				$ret = $this->appointment->update($data, $where);
				addactivty('appointment Updated');
				$this->session->set_flashdata('success', 'Appointment Updated');
				redirect('appointment/edit/' . post('appointment_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('appointment/addappointment');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->appointment->delete($u);
			addactivty('appointment Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}
	public function getproperty(){
		$search = $this->input->get('term');
		$result = $this->appointment->getSearchProperty($search);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function getprojects(){
		$search = $this->input->get('term');
		$result = $this->appointment->getSearchProjects($search);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function getTimeSlotAvailable(){
		$date = $this->input->get('date');
		$return = $this->appointment->getTimeslot($date);
		$this->output->set_content_type('application/json')->set_output(json_encode($return));

	}

}

/* End of file Appointment.php */
/* Controllers: ./application/controllers/appointment.php */