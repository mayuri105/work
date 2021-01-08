<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('transaction_models', 'transaction');
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
		
		$base_url = "/transaction/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->transaction->record_count());
		$data["pagination_helper"] = $this->pagination;
		
		$data['customer'] = $this->input->get('customer');
		$data['transaction_type'] = $this->input->get('transaction_type');
		$data['transaction_date'] = $this->input->get('transaction_date');
		
		$data["transaction"] = $this->transaction->fetch_data($perpage, (($page - 1) * $perpage));
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/transaction/index')) {
			$this->load->view('themes/' . $theme . '/template/transaction/index', $data);
		} else {
			$this->load->view('themes/default/template/transaction/index', $data);

		}
	}
	// add transaction form page
	public function addtransaction() {
		$data = array();

		$theme = $this->session->userdata('admin_theme');
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/transaction/add')) {
			$this->load->view('themes/' . $theme . '/template/transaction/add', $data);
		} else {
			$this->load->view('themes/default/template/transaction/add', $data);

		}

	}
	// edit transaction form page
	public function edit($id = '') {
		if ('' == $id) {
			redirect('transaction');
		}
		$data = array();
		$data['transaction'] = $this->transaction->gettransactionByid($id);
		$this->load->model('appointment/appointment_models', 'appointment');
		$data['cust'] = $this->appointment->getCust();
		
		$theme = $this->session->userdata('admin_theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/transaction/edit')) {
			$this->load->view('themes/' . $theme . '/template/transaction/edit', $data);
		} else {
			$this->load->view('themes/default/template/transaction/edit', $data);

		}
	}

	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('transaction_type', 'Transaction type', 'required');
		$this->form_validation->set_rules('transaction_amt', 'Transaction amt', 'required');
		$this->form_validation->set_rules('transaction_time', 'Transaction time', 'required');
		$this->form_validation->set_rules('transaction_date', 'Transaction date ', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('transaction/addtransaction');
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'transaction_date' => date('Y-m-d',strtotime(post('transaction_date'))),
					'transaction_time'=>date('H:i:s',strtotime(post('transaction_time'))),
					'transaction_type' => post('transaction_type'),
					'transaction_amt' => post('customer'),
					'added_on'=>date('Y-m-d'),
					'user_id'=>$this->session->userdata('u_id')
				);
				$ret = $this->transaction->insert($data);
				addactivty('Transaction Added');
				$this->session->set_flashdata('success', 'Transaction Added');
				redirect('transaction/addtransaction');

			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('transaction/addtransaction');
		}
	}

	public function update() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer', 'Customer name', 'required');
		$this->form_validation->set_rules('transaction_type', 'Transaction type', 'required');
		$this->form_validation->set_rules('transaction_amt', 'Transaction amt', 'required');
		$this->form_validation->set_rules('transaction_time', 'Transaction time', 'required');
		$this->form_validation->set_rules('transaction_date', 'Transaction date ', 'required');
		
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('transaction/edit/' . post('transaction_id') . '');
			} else {
				$data = array(
					'customer_id' => post('customer'),
					'transaction_date' => date('Y-m-d',strtotime(post('transaction_date'))),
					'transaction_time'=>date('H:i:s',strtotime(post('transaction_time'))),
					'transaction_type' => post('transaction_type'),
					'transaction_amt' => post('customer'),
					'user_id'=>$this->session->userdata('u_id')
				);

				$where = array('transaction_id' => post('transaction_id'));
				$ret = $this->transaction->update($data, $where);
				addactivty('Transaction Updated');
				$this->session->set_flashdata('success', 'Transaction Updated');
				redirect('transaction/edit/' . post('transaction_id') . '');
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('transaction/addtransaction');
		}
	}

	function deletemultiple() {

		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->transaction->delete($u);
			addactivty('transaction Deleted');
			$this->output->set_content_type('application/json')->set_output(json_encode($ret));
		}

	}

}

/* End of file transaction.php */
/* transaction: ./application/controllers/transaction.php */