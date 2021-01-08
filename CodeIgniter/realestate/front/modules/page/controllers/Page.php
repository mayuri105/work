<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {
	
	public function __construct(){

		parent::__construct();
		$this->load->model('page_model', 'page');
	}

	
	public function show($url)
	{
		
		$page = $this->page->getpage($url);	
		if(empty($page)){
			redirect('/','refresh');
		}
		$data =array();
		$data['title'] = $this->setting->get('site_name');
		$data['page'] = $page;
		$data['company_name'] = $this->setting->get('company_name');
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['email_address'] = $this->setting->get('email_address');
		$data['facebook'] = $this->setting->get('facebook');
		
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/index')) {
            $this->load->view('themes/' . $theme . '/template/page/index', $data);
        }else{
            $this->load->view('themes/default/template/page/index', $data);
        }	

	}

	public function contact_us(){
		$data =array();
		$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		$data['company_name'] = $this->setting->get('company_name');
		$data['address'] = $this->setting->get('address');
		$data['phone'] = $this->setting->get('phone');
		$data['email_address'] = $this->setting->get('email_address');
		$data['facebook'] = $this->setting->get('facebook');
		
		$theme = $this->session->userdata('front_theme');

        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/contact_us')) {
            $this->load->view('themes/' . $theme . '/template/page/contact_us', $data);
        }else{
            $this->load->view('themes/default/template/page/contact_us', $data);
        }	
	}

	public function contactsubmit() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|is_numeric|min_length[10]');
		
		if ($this->form_validation->run() == FALSE) {
			$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
		} else {
			$data = array(
				'name' => post('name'),
				'email' => post('email'),
				'phone' => post('phone'),
				'message' => post('message'),
				'added_date' => date('Y-m-d'),
			);
			$ret = $this->page->insertContact($data);
			// send mail here
			//$this->sendmail();
			$return = array('n'=>1,'Type'=>'Success','Message'=>'Thanks for contact us we will shortly contact you.');
			$this->output->set_content_type('application/json')->set_output(json_encode($return));
		}

	}

}

/* End of file Page.php */
/* Location: ../controllers/Page.php */