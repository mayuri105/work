<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Settings extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('setting_models', 'setting');
		// usergroups rights checked here helper class function checkRights
		!checkRights() ? show_error('You dont have permission for this page', 403) : '';

	}
	public function index() {
		$this->load->helper('directory');
		//themes
		$data = array();
		$data['admin_themes'] = directory_map(APPPATH . '/views/themes', 1);
		// genearal tab
		$data['site_name'] = $this->setting->get('site_name');
		$data['owner'] = $this->setting->get('owner');
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['admin_theme'] = $this->setting->get('admin_theme');
		$data['front_theme'] = $this->setting->get('front_theme');
		$data['language'] = $this->setting->get('language');

		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');

		$data['multiple_store_order'] = $this->setting->get('multiple_store_order');
		$data['redeem_points'] = $this->setting->get('redeem_points');
		$data['refbycredits'] = $this->setting->get('refbycredits');
		$data['minorder_for_credits'] = $this->setting->get('minorder_for_credits');
		$data['google_api_key'] = $this->setting->get('google_api_key');
		$data['per_page'] = $this->setting->get('per_page');

		$data['mail_protocol'] = $this->setting->get('mail_protocol');
		$data['smtp_host'] = $this->setting->get('smtp_host');
		$data['smtp_port'] = $this->setting->get('smtp_port');
		$data['smtp_timeout'] = $this->setting->get('smtp_timeout');
		$data['smtp_user'] = $this->setting->get('smtp_user');
		$data['smtp_pass'] = $this->setting->get('smtp_pass');

		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['instagram'] = $this->setting->get('instagram');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['appstorelink'] = $this->setting->get('appstorelink');
		$data['playstorelink'] = $this->setting->get('playstorelink');

		$data['merchant_type'] = $this->setting->getmerchanttype();

		$data['twilio_sid'] = $this->setting->get('twilio_sid');
		$data['twilio_auth_token'] = $this->setting->get('twilio_auth_token');
		$data['twilio_messaging_service_sid'] = $this->setting->get('twilio_messaging_service_sid');
		$data['sms_enabled'] = $this->setting->get('sms_enabled');
		
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/settings/index')) {
			$this->load->view('themes/' . $theme . '/template/settings/index', $data);
		} else {
			$this->load->view('themes/default/template/settings/index', $data);
		}

	}

	public function savesettings() {
		if (checkModification()) {

			$this->setting->update('site_name', post('site_name'));
			$this->setting->update('owner', post('owner'));
			$this->setting->update('address', post('address'));
			$this->setting->update('phone', post('phone'));
			$this->setting->update('admin_theme', post('admin_theme'));
			$this->setting->update('front_theme', post('front_theme'));
			$this->setting->update('language', post('language'));

			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}
	function savesettingsmail() {
		if (checkModification()) {
			$ret = $this->setting->update('admin_forgott_mail_template', post('admin_forgott_mail_template'));
			$ret = $this->setting->update('customer_forgott_mail_template', post('customer_forgott_mail_template'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}

	function smtpsetting() {
		if (checkModification()) {
			$ret = $this->setting->update('mail_protocol', post('mail_protocol'));
			$ret = $this->setting->update('smtp_host', post('smtp_host'));
			$ret = $this->setting->update('smtp_port', post('smtp_port'));
			$ret = $this->setting->update('smtp_timeout', post('smtp_timeout'));
			$ret = $this->setting->update('smtp_user', post('smtp_user'));
			$ret = $this->setting->update('smtp_pass', post('smtp_pass'));

			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}
	}

	function socialmediasetting() {
		if (checkModification()) {
			$this->setting->update('facebook', $this->input->post('facebook'));
			$this->setting->update('twitter', $this->input->post('twitter'));
			$this->setting->update('instagram', $this->input->post('instagram'));
			$this->setting->update('googleplus', $this->input->post('googleplus'));
			$this->setting->update('appstorelink', $this->input->post('appstorelink'));
			$this->setting->update('playstorelink', $this->input->post('playstorelink'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}
	function optionsettings() {
		if (checkModification()) {
			$this->setting->update('multiple_store_order', $this->input->post('multiple_store_order'));
			$this->setting->update('redeem_points', $this->input->post('redeem_points'));
			$this->setting->update('refbycredits', $this->input->post('refbycredits'));
			$this->setting->update('minorder_for_credits', $this->input->post('minorder_for_credits'));
			$this->setting->update('google_api_key', $this->input->post('google_api_key'));
			$this->setting->update('per_page', $this->input->post('per_page'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}

	function seosetting() {
		if (checkModification()) {
			$this->setting->update('meta_titles', $this->input->post('meta_titles'));
			$this->setting->update('meta_keywords', $this->input->post('meta_keywords'));
			$this->setting->update('meta_descriptions', $this->input->post('meta_descriptions'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}

	public function mailtemplate() {
		$data = array();
		$data['mailtemplates'] = $this->setting->getMailTemp();
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/settings/mail')) {
			$this->load->view('themes/' . $theme . '/template/settings/mail', $data);
		} else {
			$this->load->view('themes/default/template/settings/mail', $data);
		}
	}

	public function editmailtemplates($id = '') {
		if ('' == $id) {
			redirect('mailtemplate');
		}
		$data = array();
		$data['mail'] = $this->setting->getMailTempByid($id);
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/settings/editmail')) {
			$this->load->view('themes/' . $theme . '/template/settings/editmail', $data);
		} else {
			$this->load->view('themes/default/template/settings/editmail', $data);
		}
	}
	public function addmailtemplate() {

		$data = array();
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/settings/addmail')) {
			$this->load->view('themes/' . $theme . '/template/settings/addmail', $data);
		} else {
			$this->load->view('themes/default/template/settings/addmail', $data);
		}
	}
	public function updatemailtemp() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mail_content', 'Mail Content', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('settings/editmailtemplates/' . post('mt_id') . '');
			} else {
				$data = array(
					'mail_content' => post('mail_content'),
					'send_msg' => post('send_msg'),
					'msg_template' => post('msg_template'),
						
				);

				$where = array('mt_id' => post('mt_id'));
				$this->setting->updateMail($data, $where);

				if ($ret) {
					$this->session->set_flashdata('success', 'Mail template Updated ');
					redirect('settings/editmailtemplates/' . post('mt_id') . '');
				} else {

					$this->session->set_flashdata('error', 'Error In update');
					redirect('settings/editmailtemplates/' . post('mt_id') . '');
				}
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings/editmailtemplates/' . post('mt_id') . '');
		}
	}
	public function smssetting() {
		if (checkModification()) {
			$this->setting->update('twilio_sid', $this->input->post('twilio_sid'));
			$this->setting->update('twilio_auth_token', $this->input->post('twilio_auth_token'));
			$this->setting->update('twilio_messaging_service_sid', $this->input->post('twilio_messaging_service_sid'));
			$this->setting->update('sms_enabled', $this->input->post('sms_enabled'));
			
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings');
		}

	}
	public function checksms() {
		$this->load->helper('twilio');
		$sid = $this->setting->get('twilio_sid');
		$token = $this->setting->get('twilio_auth_token');
		$twilio_messaging_service_sid = $this->setting->get('twilio_messaging_service_sid');
		$service = get_twilio_service($sid, $token);
		$sms =  $service->account->messages->create(array(
			'To' => "+917574862602",
			'MessagingServiceSid' => "MG89ac88e3e5beed7276b134c876fea10d",
			'Body' => "Phantom Menace was clearly the best of the prequel trilogy.",
		));
		echo $sms;
	}


}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */