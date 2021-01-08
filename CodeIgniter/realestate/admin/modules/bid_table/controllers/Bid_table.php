<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bid_table extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('bid_table_models', 'bid_table');
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
		
		$base_url = "/bid_table/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->bid_table->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['are'] = $this->input->get('bid_table');
		$data["bid_table"] = $this->bid_table->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_table/index')) {
			$this->load->view('themes/' . $theme . '/template/bid_table/index', $data);
		} else {
			$this->load->view('themes/default/template/bid_table/index', $data);

		}
	}
	// add bid_table form page
	public function addbid_date() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_table/add')) {
			$this->load->view('themes/' . $theme . '/template/bid_table/add', $data);
		} else {
			$this->load->view('themes/default/template/bid_table/add', $data);

		}

	}
	// edit bid_table form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('bid_table');
		}
		$data = array();
		$data['bid_table'] = $this->bid_table->getbid_tableByid($id);
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/bid_table/edit')) {
			$this->load->view('themes/' . $theme . '/template/bid_table/edit', $data);
		} else {
			$this->load->view('themes/default/template/bid_table/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('date', 'date ', 'required');
		$this->form_validation->set_rules('start_time', 'start_time ', 'required');
		$this->form_validation->set_rules('end_time', 'end_time ', 'required');
	
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('bid_table/addbid_date');
			} else {
				$data = array(
					'date' => date('Y-m-d',strtotime(post('date'))),
					'start_time'=> date('H:i:s',strtotime(post('start_time'))),
					'end_time' =>  date('H:i:s',strtotime(post('end_time'))),
					
				);

				$ret = $this->bid_table->insert($data);
				addactivty('Bid_time_table Added');
				$this->session->set_flashdata('success', 'Bid Table Schedule Added');
				redirect('bid_table/addbid_date');
				

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('bid_table/addbid_table');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('date', 'date ', 'required');
		$this->form_validation->set_rules('start_time', 'start_time ', 'required');
		$this->form_validation->set_rules('end_time', 'end_time ', 'required');
	
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('bid_table/edit/' . post('bid_table_id') . '');
			} else {
				$data = array(
					'date' => date('Y-m-d',strtotime(post('date'))),
					'start_time'=> date('H:i:s',strtotime(post('start_time'))),
					'end_time' =>  date('H:i:s',strtotime(post('end_time'))),
				);

				$where = array('btt_id' => post('btt_id'));
				$ret = $this->bid_table->update($data, $where);
				
				addactivty('bid_table Updated');
				$this->session->set_flashdata('success', 'Bid Table Schedule Updated');
				redirect('bid_table/edit/' . post('bid_table_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('bid_table/addbid_table');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->bid_table->delete($u);
			addactivty('bid_table Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file Amenites.php */
/* bid_table: ./application/controllers/Amenites.php */