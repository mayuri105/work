<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/index')) {
			$this->load->view('themes/' . $theme . '/template/module/index', $data);
		} else {
			$this->load->view('themes/default/template/module/index', $data);
			
		}
	}

	public function themeoption(){
		$data = array();
		$this->load->helper('directory');
		//themes
		$theme = $this->session->userdata('admin_theme');
		$data['admin_themes'] = directory_map(APPPATH . '/views/themes', 1);
		// genearal tab
		$data['site_name'] = $this->setting->get('site_name');
		$data['owner'] = $this->setting->get('owner');
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['admin_theme'] = $this->setting->get('admin_theme');
		$data['front_theme'] = $this->setting->get('front_theme');
		$data['logoimage'] = $this->setting->get('logoimage');
		$data['aboutus'] = $this->setting->get('aboutus');
		
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/theme_option')) {
			$this->load->view('themes/' . $theme . '/template/module/theme_option', $data);
		} else {
			$this->load->view('themes/default/template/module/theme_option', $data);
			
		}	
	}
	public function seo(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		//load view 
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/seo')) {
			$this->load->view('themes/' . $theme . '/template/module/seo', $data);
		} else {
			$this->load->view('themes/default/template/module/seo', $data);
			
		}	
	}
	public function smsapi(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		$data['config_sms_sender_id'] = $this->setting->get('config_sms_sender_id');
		$data['config_sms_username'] = $this->setting->get('config_sms_username');
		$data['config_sms_password'] = $this->setting->get('config_sms_password');
		
		$data['sms_enabled'] = $this->setting->get('sms_enabled');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/smsapi')) {
			$this->load->view('themes/' . $theme . '/template/module/smsapi', $data);
		} else {
			$this->load->view('themes/default/template/module/smsapi', $data);
			
		}	
	}

	public function socialmedia(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		$data['facebook'] = $this->setting->get('facebook');
		$data['twitter'] = $this->setting->get('twitter');
		$data['instagram'] = $this->setting->get('instagram');
		$data['googleplus'] = $this->setting->get('googleplus');
		$data['appstorelink'] = $this->setting->get('appstorelink');
		$data['playstorelink'] = $this->setting->get('playstorelink');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/socialmedia')) {
			$this->load->view('themes/' . $theme . '/template/module/socialmedia', $data);
		} else {
			$this->load->view('themes/default/template/module/socialmedia', $data);
			
		}	
	}
	public function otheroptions(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		$data['secret'] = $this->setting->get('secret');
		$data['google_client_id'] = $this->setting->get('google_client_id');
		$data['google_client_secret'] = $this->setting->get('google_client_secret');
		$data['per_page'] = $this->setting->get('per_page');
		$data['fb_app_id'] = $this->setting->get('fb_app_id');
		$data['advancedlogin_gpwdsecret'] = $this->setting->get('advancedlogin_gpwdsecret');

		$data['sidebar_ads'] = $this->setting->get('sidebar_ads');
		
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/otheroption')) {
			$this->load->view('themes/' . $theme . '/template/module/otheroption', $data);
		} else {
			$this->load->view('themes/default/template/module/otheroption', $data);
			
		}	
	}
	public function mailoption(){
		$data = array();
		$theme = $this->session->userdata('admin_theme');

		$data['mail_protocol'] = $this->setting->get('mail_protocol');
		$data['smtp_host'] = $this->setting->get('smtp_host');
		$data['smtp_port'] = $this->setting->get('smtp_port');
		$data['smtp_timeout'] = $this->setting->get('smtp_timeout');
		$data['smtp_user'] = $this->setting->get('smtp_user');
		$data['smtp_pass'] = $this->setting->get('smtp_pass');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/mailoption')) {
			$this->load->view('themes/' . $theme . '/template/module/mailoption', $data);
		} else {
			$this->load->view('themes/default/template/module/mailoption', $data);
			
		}	

	}
	public function saveMailOption(){
		if (checkModification()) {
			$this->setting->update('mail_protocol', post('mail_protocol'));
			$this->setting->update('smtp_host', post('smtp_host'));
			$this->setting->update('smtp_port', post('smtp_port'));
			$this->setting->update('smtp_timeout', post('smtp_timeout'));
			$this->setting->update('smtp_user', post('smtp_user'));
			$this->setting->update('smtp_pass', post('smtp_pass'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('module/mailoption');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/mailoption');
		}
	}
	public function saveOtherOption(){
		if (checkModification()) {
			$this->setting->update('google_client_id', post('google_client_id'));
			$this->setting->update('secret', post('secret'));
			$this->setting->update('per_page', post('per_page'));
			$this->setting->update('google_client_secret', post('google_client_secret'));			
			$this->setting->update('fb_app_id', post('fb_app_id'));			
			$this->setting->update('advancedlogin_gpwdsecret', post('advancedlogin_gpwdsecret'));			
			$this->setting->update('sidebar_ads', $this->input->post('sidebar_ads',false));			
			
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('module/otheroptions');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/otheroptions');
		}
	}
	public function saveSocialMedia(){
		if (checkModification()) {
			$this->setting->update('facebook', post('facebook'));
			$this->setting->update('twitter', post('twitter'));
			$this->setting->update('instagram', post('instagram'));
			$this->setting->update('appstorelink', post('appstorelink'));
			$this->setting->update('playstorelink', post('playstorelink'));
			$this->setting->update('googleplus', post('googleplus'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('module/socialmedia');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/socialmedia');
		}
	}

	public function saveSmsApi(){
		if (checkModification()) {
			$this->setting->update('config_sms_sender_id', post('config_sms_sender_id'));
			$this->setting->update('config_sms_username', post('config_sms_username'));
			$this->setting->update('config_sms_password', post('config_sms_password'));
			$this->setting->update('sms_enabled', post('sms_enabled'));
			$this->session->set_flashdata('success', 'Updated Successfully');


			redirect('module/smsapi');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/smsapi');
		}
	}
	public function saveMetatag(){
		if (checkModification()) {
			$this->setting->update('meta_titles', post('meta_titles'));
			$this->setting->update('meta_keywords', post('meta_keywords'));
			$this->setting->update('meta_descriptions', post('meta_descriptions'));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('module/seo');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/seo');
		}
	}
	public function savethemesetting(){
		if (checkModification()) {

			$this->setting->update('site_name', post('site_name'));
			$this->setting->update('owner', post('owner'));
			$this->setting->update('address', post('address'));
			$this->setting->update('aboutus', post('aboutus'));
			
			$this->setting->update('phone', post('phone'));
			$this->setting->update('admin_theme', post('admin_theme'));
			$this->setting->update('front_theme', post('front_theme'));

			$upload_path =  $this->config->item('upload_path').'/theme';

            if (!file_exists($upload_path)) {
			    mkdir($upload_path, 0777, true);
			}
            $c_upload['upload_path']    =  $upload_path;
            $c_upload['allowed_types']  = 'gif|jpg|png|jpeg|x-png';
            $this->load->library('upload', $c_upload);
        	if ($this->upload->do_upload('logoimage')) {
        		$image = $this->upload->data();
        		$this->setting->update('logoimage', $image['file_name']);

        	}
        	if ($this->upload->do_upload('backimage')) {
        		$image = $this->upload->data();
        		$this->setting->update('backimage', $image['file_name']);

        	}
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect('module/themeoption');
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/themeoption');
		}
	}
	public function templates() {
		$data = array();
		$data['mailtemplates'] = $this->setting->getMailTemp();
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/mail')) {
			$this->load->view('themes/' . $theme . '/template/module/mail', $data);
		} else {
			$this->load->view('themes/default/template/module/mail', $data);
		}
	}

	public function editmailtemplates($id = '') {
		if ('' == $id) {
			redirect('mailtemplate');
		}
		$data = array();
		$data['mail'] = $this->setting->getMailTempByid($id);
		$theme = $this->session->userdata('theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/module/editmail')) {
			$this->load->view('themes/' . $theme . '/template/module/editmail', $data);
		} else {
			$this->load->view('themes/default/template/module/editmail', $data);
		}
	}
	public function updatemailtemp() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mail_content', 'Mail Content', 'required');

		if (checkModification()) {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect('module/editmailtemplates/' . post('mt_id') . '');
			} else {
				$data = array(
					'mail_content' => post('mail_content'),
					'send_msg' => post('send_msg'),
					'msg_template' => post('msg_template'),
						
				);
				$where = array('mt_id' => post('mt_id'));
				$this->setting->updateMail($data, $where);
				$this->session->set_flashdata('success', 'Mail template Updated ');
				redirect('module/editmailtemplates/' . post('mt_id') . '');
				
			}
		} else {
			$this->session->set_flashdata('warnings', 'You do not have permission to modify');
			redirect('module/editmailtemplates/' . post('mt_id') . '');
		}
	}
}

/* End of file Modules.php */
/* Location: ./application/controllers/Modules.php */