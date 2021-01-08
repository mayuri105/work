<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_models', 'page');
		$this->load->library('Pagination');
		$this->load->helper('url');
		$this->load->library('Paginationlib');
	}

	public function show($slug)
	{
		
		
		$page = $this->page->getpage($slug);	
		if(empty($page)){
			redirect('/','refresh');
		}
		$data =array();
		$data['page'] =  $this->page->getPage($slug);
		
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/index')) {
            $this->load->view('themes/' . $theme . '/template/pages/index', $data);
        }else{
            $this->load->view('themes/default/template/pages/index', $data);
        }	

	}
	

public function about()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('front_theme');
		
		$data['about']= $this->page->getPage('about');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/about')) {
			$this->load->view('themes/' . $theme . '/template/pages/about', $data);
		} else {
			$this->load->view('themes/default/template/pages/about', $data);
		}
	}
	public function termscondition()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('front_theme');
		$data['term']= $this->page->getPage('term-condition');
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/terms')) {
			$this->load->view('themes/' . $theme . '/template/pages/terms', $data);
		} else {
			$this->load->view('themes/default/template/pages/terms', $data);
		}
	}
	public function privacy()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('front_theme');
		
		$data['privacy']= $this->page->getPage('privacy-policy');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/privacy')) {
			$this->load->view('themes/' . $theme . '/template/pages/privacy', $data);
		} else {
			$this->load->view('themes/default/template/pages/privacy', $data);
		}
	}
	public function contact()
	{
		$data = array();
		//load view 
		$theme = $this->session->userdata('front_theme');
		
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/contact')) {
			$this->load->view('themes/' . $theme . '/template/pages/contact', $data);
		} else {
			$this->load->view('themes/default/template/pages/contact', $data);
		}
	}
	
	
	public function brand() {

		$perpage = $this->setting->get('brandper_page');

		

		if($this->input->get('page'))	{

			$page = $this->input->get('page');

		}else{

			$page=1;

		}

		

		$base_url = "/brands?";

		$t = $this->input->get();

		unset($t['page']);

        $base_url .= http_build_query($t);

		$pagingConfig   = $this->paginationlib->initPagination($base_url,$perpage,$this->page->record_countbrand());

		$data = array();

        $data["pagination_helper"]   = $this->pagination;
		$data["brands"] = $this->page->fetch_databrand($perpage ,(($page-1) * $perpage));
		//$data['brands']= $this->page->getbrand();

		$theme = $this->session->userdata('front_theme');

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/brand')) {
			$this->load->view('themes/' . $theme . '/template/pages/brand', $data);
		} else {
			$this->load->view('themes/default/template/pages/brand', $data);
		}

	}

	
	public function brandold()
	{
		$data = array();
		//load view 
		$data['brands']= $this->page->getbrand();
		$theme = $this->session->userdata('front_theme');
		
		//$data['menus']= $this->menus->getFullListFromDB();

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/pages/brand')) {
			$this->load->view('themes/' . $theme . '/template/pages/brand', $data);
		} else {
			$this->load->view('themes/default/template/pages/brand', $data);
		}
	}
	
	public function addcontact() {
		//echo 'hie';
	$this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
				$this->form_validation->set_rules('fname', 'firstname', 'required');
				$this->form_validation->set_rules('lname', 'lastname', 'required'); 
				$this->form_validation->set_rules('email', 'email', 'required|valid_email'); 
				$this->form_validation->set_rules('cname', 'Company Name', 'required'); 
				$this->form_validation->set_rules('enquiry_type', 'Enquiry Type', 'required');
				$this->form_validation->set_rules('others', 'others', 'required'); 
				$this->form_validation->set_rules('country', 'country', 'required'); 
				$this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]'); 
				$this->form_validation->set_rules('industry', 'industry', 'required');
				$this->form_validation->set_rules('message', 'message', 'required'); 
				

			
         if ($this->form_validation->run() == FALSE) {
         		$this->session->set_flashdata('error', validation_errors());
         		redirect('contact');

         }
         	else{
		$admin_email=$this->setting->get('email_address');
		$user_email=post('q3_email');
		$data = array(
					'fname' => post('fname'),
					'lname' => post('lname'),
					'email' => post('email'),
					'cname' => post('cname'),
					'enquiry_type' => post('enquiry_type'),
					'others' => post('others'),
					'country' => post('country'),
					'phone' => post('phone'),
					'industry' => post('industry'),
					'message' => post('message'),
				);

					$ret = $this->page->insert($data);
/*
					$this->load->library('email');
					$config['protocol']     = $this->setting->get('mail_protocol');//'smtp';
			        $config['smtp_host']    = $this->setting->get('smtp_host');//'ssl://smtp.gmail.com';
			        $config['smtp_port']    = $this->setting->get('smtp_port');//'465';
			        $config['smtp_timeout'] = $this->setting->get('smtp_timeout');//'7';
			        $config['smtp_user']    = $this->setting->get('smtp_user');//'mygmail@gmail.com';
			        $config['smtp_pass']    = $this->setting->get('smtp_pass');
			        $config['charset']      = 'utf-8';
			        $config['newline']      = "\r\n";
			        $config['mailtype']     = 'html';
			        $this->email->initialize($config);

					$this->email->from($user_email);
					$this->email->to($admin_email);
					
					$this->email->subject('User Contact');
					$msg = $this->load->view('themes/default/template/emailtemp/contactuser', $data,TRUE);
					$this->email->message($msg);
					$this->email->send();*/
					//echo $this->email->print_debugger();
					//redirect('thanks');
					$this->session->set_flashdata('success', 'Thank you');
				redirect('contact');
					//redirect('contact');
	}
	
}
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */ ?>