<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Merchant extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('merchant_model', 'merchant');
		$this->load->library('pagination');
		$this->load->library('paginationlib');
		$this->load->library('encrypt');
		
	}

	public function index() {

		$data = array();
		$perpage = $this->setting->get('per_page');
		if($this->input->get('page'))	{
			$page = $this->input->get('page');
		}else{
			$page=1;
		}
		$base_url = "/merchant/index?";
		$t = $this->input->get();
		unset($t['page']);
        $base_url .= http_build_query($t);
		$pagingConfig = $this->paginationlib->initPagination($base_url, $perpage, $this->merchant->record_count());
		$data["pagination_helper"] = $this->pagination;
		$data["merchants"] = $this->merchant->fetch_data($perpage, (($page - 1) * $perpage));
		
		$data['merchant'] = $this->input->get('merchant');
        $data['email'] = $this->input->get('email');
        $data['phone'] = $this->input->get('phone');
        $data['approved'] = $this->input->get('approved');
        $data['date_added'] = date('m-d-Y',strtotime($this->input->get('date_added')));

        $data['city'] = $this->input->get('city');
		$theme = $this->session->userdata('theme');
		//load view
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/merchant/index')) {
			$this->load->view('themes/' . $theme . '/template/merchant/index', $data);
		} else {
			$this->load->view('themes/default/template/merchant/index', $data);

		}
	}
	// add new merchant method
	public function addnew() {

		$data = array();
		//load view
		$data['state'] = getstate();

		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/merchant/add')) {
			$this->load->view('themes/' . $theme . '/template/merchant/add', $data);
		} else {
			$this->load->view('themes/default/template/merchant/add', $data);
		}
	}
	// submit method for add merchant
	public function addnewmerchant() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email|is_unique[merchant.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

		$this->form_validation->set_rules('business_name', 'Business Name', 'required|max_length[32]');
		$this->form_validation->set_rules('physical_street', 'Physical street', 'required|max_length[32]');
		$this->form_validation->set_rules('physical_city', 'Physical city', 'required|max_length[32]');
		$this->form_validation->set_rules('physical_zipcode', 'Physical Zipcode', 'required|max_length[6]');
		$this->form_validation->set_rules('federaltaxid', 'Federal tax id', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');
		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				$data = array();
				$data['state'] = getstate();
				$theme = $this->session->userdata('admin_theme');
				if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/merchant/add')) {
					$this->load->view('themes/' . $theme . '/template/merchant/add', $data);
				} else {
					$this->load->view('themes/default/template/merchant/add', $data);
				}
			} else {
				$ret = $this->merchant->insert();
				addactivity('Merchant Added ');
				$this->session->set_flashdata('success', 'Merchant Added successfully');
				redirect('merchant/addnew');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('merchant/addnew');
		}
	}

	// edit form
	public function edit($id = '') {
		if ('' == $id) {
			redirect('merchant');
		}

		$data = array();
		$data['state'] = getstate();
		$data['merchant'] = $this->merchant->getmerchant($id);
		$data['orders'] = $this->merchant->getordersByMer($id);
		$data['stores'] = $this->merchant->getstoresByMer($id);
		
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/merchant/edit')) {
			$this->load->view('themes/' . $theme . '/template/merchant/edit', $data);
		} else {
			$this->load->view('themes/default/template/merchant/edit', $data);
		}
	}
	// update merchant
	public function update() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('business_name', 'Business Name', 'required');
		$this->form_validation->set_rules('physical_street', 'Physical street', 'required');
		$this->form_validation->set_rules('physical_city', 'Physical city', 'required');
		$this->form_validation->set_rules('physical_zipcode', 'Physical Zipcode', 'required');
		$this->form_validation->set_rules('frequency', 'frequency', 'required');
		$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('merchant/edit/'.post("m_id").'');
			} else {
				$ret = $this->merchant->merchantupdate();
				addactivity('Merchant Updated ');
				$this->session->set_flashdata('success', 'Merchant Updated successfully');
				redirect('merchant/edit/'.post("m_id").'');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('merchant/edit/'.post("m_id").'');
		}

	}
	// delelte merchant method
	public function deletemultiple() {
		foreach ($this->input->post('delete') as $u) {
			$this->session->set_flashdata('success', 'Deleted Successfully  ');
			$ret = $this->merchant->delete($u);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($jet));
	}
	public function addtransaction() {
		if (post('ajax')) {
			$ret = $this->merchant->addtransaction();
			/*send mail and sms if sms is enabled*/
			$merchant_id = post('merchant_id');
			$transaction_type = post('transaction_type');
			$amount = post('amount');
			$merchant = $this->merchant->getmerchant($merchant_id);
			$merchanEmail = $merchant->merchantinfo->username;
			$phone = $merchant->merchantinfo->phone;

			$merchant_transaction = $this->setting->getMail('merchant_transaction');
			$company_name = $this->setting->get('site_name');
			$subject = ' Transaction on' . $company_name;
			$search = array('{transaction_type}', '{amount}');
			$replace = array($transaction_type, $amount);
			$message = str_replace($search, $replace, $merchant_transaction);
			$this->sendmailconfig($to, $subject, $message);

			// Mail done
			// send msg
			$sms_enabled = $this->setting->get('sms_enabled');
			if ($sms_enabled) {

				$isMsgEnabled = $this->setting->isMsgEnabled('merchant_transaction');
				$merchantTranMsg = $this->setting->getMsg('merchant_transaction');
				$replace = array($transaction_type, $amount);
				$smsMsg = str_replace($search, $replace, $merchantTranMsg);
				if ($isMsgEnabled) {
					$this->load->helper('twilio');
					$sid = $this->setting->get('twilio_sid');
					$token = $this->setting->get('twilio_auth_token');
					$twilio_messaging_service_sid = $this->setting->get('twilio_messaging_service_sid');
					$service = get_twilio_service($sid, $token);

					if ($phone) {
						$phoneNo = '+' . $phone;
						$sms = $service->account->messages->create(array(
							'To' => $phoneNo,
							'MessagingServiceSid' => $twilio_messaging_service_sid,
							'Body' => $smsMsg,
						));
					}
				}
			}
			echo json_encode($ret);

		}
	}

	protected function sendmailconfig($to, $subject, $message) {
		$email_address = $this->setting->get('email_address');
		$company_name = $this->setting->get('site_name');
		$this->load->library('email');
		$config['protocol'] = $this->setting->get('mail_protocol'); //'smtp';
		$config['smtp_host'] = $this->setting->get('smtp_host'); //'ssl://smtp.gmail.com';
		$config['smtp_port'] = $this->setting->get('smtp_port'); //'465';
		$config['smtp_timeout'] = $this->setting->get('smtp_timeout'); //'7';
		$config['smtp_user'] = $this->setting->get('smtp_user'); //'mygmail@gmail.com';
		$config['smtp_pass'] = $this->setting->get('smtp_pass');
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($email_address, $company_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		return true;
	}

	public function loginasmerchant($id) {
		
		if (checkModification()) {
			if ($id) {
				$ret = $this->merchant->getmerchant($id);
				$userdata = array(
					'm_id' => $ret->merchantinfo->m_id,
					'username' => $ret->merchantinfo->username,
					'is_merchant' => 1
				);
				$unsetForOther = array('u_id', 'is_admin');
				$this->session->unset_userdata($unsetForOther);
				$this->session->set_userdata($userdata);
				redirect(site_url('../merchant/index'),'refresh');
			}
		}

	}

}

/* End of file merchant.php */
/* Location: ./application/controllers/merchant.php */