<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function sms_settings()
	{
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		$data['twilio_sid'] = $this->setting->get('twilio_sid');
		$data['twilio_auth_token'] = $this->setting->get('twilio_auth_token');
		$data['twilio_messaging_service_sid'] = $this->setting->get('twilio_messaging_service_sid');
		$data['sms_enabled'] = $this->setting->get('sms_enabled');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/settings/smsapi')) {
			$this->load->view('themes/' . $theme . '/template/settings/smsapi', $data);
		} else {
			$this->load->view('themes/default/template/settings/smsapi', $data);
			
		}
	}
	public function saveSmsApi(){
		if (checkModification()) {
			$this->setting->update('twilio_sid', post('twilio_sid'));
			$this->setting->update('twilio_auth_token', post('twilio_auth_token'));
			$this->setting->update('twilio_messaging_service_sid', post('twilio_messaging_service_sid'));
			$this->setting->update('sms_enabled', post('sms_enabled'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('settings/smsapi');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('settings/smsapi');
		}
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */