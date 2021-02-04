<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	public function __construct()
	{
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
		$data['bodyclass'] ='page-repeat-orders';
		$data['page'] = $page;
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/index')) {
            $this->load->view('themes/' . $theme . '/template/page/index', $data);
        }else{
            $this->load->view('themes/default/template/page/index', $data);
        }	

	}


public  function about()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/aboutus')) {
            $this->load->view('themes/' . $theme . '/template/page/aboutus', $data);
        }else{
            $this->load->view('themes/default/template/page/aboutus', $data);
        }
	}
public  function product()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/product')) {
            $this->load->view('themes/' . $theme . '/template/page/product', $data);
        }else{
            $this->load->view('themes/default/template/page/product', $data);
        }
	}
public  function product_detail()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/product_detail')) {
            $this->load->view('themes/' . $theme . '/template/page/product_detail', $data);
        }else{
            $this->load->view('themes/default/template/page/product_detail', $data);
        }
	}
public  function faq()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/faq')) {
            $this->load->view('themes/' . $theme . '/template/page/faq', $data);
        }else{
            $this->load->view('themes/default/template/page/faq', $data);
        }
	}
public  function delivery_shipping_policy()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/delivery_shipping_policy')) {
            $this->load->view('themes/' . $theme . '/template/page/delivery_shipping_policy', $data);
        }else{
            $this->load->view('themes/default/template/page/delivery_shipping_policy', $data);
        }
	}
public  function cancellation()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/cancellation')) {
            $this->load->view('themes/' . $theme . '/template/page/cancellation', $data);
        }else{
            $this->load->view('themes/default/template/page/cancellation', $data);
        }
	}
public  function policy_for_buyer()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/policy_for_buyer')) {
            $this->load->view('themes/' . $theme . '/template/page/policy_for_buyer', $data);
        }else{
            $this->load->view('themes/default/template/page/policy_for_buyer', $data);
        }
	}
public  function refund_return_policy()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/refund_return_policy')) {
            $this->load->view('themes/' . $theme . '/template/page/refund_return_policy', $data);
        }else{
            $this->load->view('themes/default/template/page/refund_return_policy', $data);
        }
	}
public  function privacy_policy()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/privacy_policy')) {
            $this->load->view('themes/' . $theme . '/template/page/privacy_policy', $data);
        }else{
            $this->load->view('themes/default/template/page/privacy_policy', $data);
        }
	}
public  function pricing()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/pricing')) {
            $this->load->view('themes/' . $theme . '/template/page/pricing', $data);
        }else{
            $this->load->view('themes/default/template/page/pricing', $data);
        }
	}
public  function login()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/login')) {
            $this->load->view('themes/' . $theme . '/template/page/login', $data);
        }else{
            $this->load->view('themes/default/template/page/login', $data);
        }
	}
public  function register()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/register')) {
            $this->load->view('themes/' . $theme . '/template/page/register', $data);
        }else{
            $this->load->view('themes/default/template/page/register', $data);
        }
	}
public  function wishlist()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/wishlist')) {
            $this->load->view('themes/' . $theme . '/template/page/wishlist', $data);
        }else{
            $this->load->view('themes/default/template/page/wishlist', $data);
        }
	}
public  function contact()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/contactus')) {
            $this->load->view('themes/' . $theme . '/template/page/contactus', $data);
        }else{
            $this->load->view('themes/default/template/page/contactus', $data);
        }
	}
public function contact_us()
{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
		$this->form_validation->set_rules('msg', 'Message', 'required');

		//$this->form_validation->set_rules('shop_cat', 'Category', 'required');
		
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('page/contact');
        }
        else
        {
        	$data= array(
		        	'firstname'=>post('first_name'),
		        	'lastname'=>post('last_name'),
	        		'email'=>post('email'),
	        		'phone'=>post('phone'),
	        		'message'=>post('msg'),
	
		        			        		
		        	);	
        	$ret = $this->page->insertcontact($data);
		        
        		
        	
        	if($ret){
        		$email= post('email');
        		//echo $email;die;
        		$firstname = post('first_name');
        		$lastname= post('last_name');
        		$phone= post('phone');
        		$msg= post('msg');
        		$this->sendcontactmail($email,$firstname,$lastname,$phone,$msg);

        		$this->session->set_flashdata('success','thank you for inquiry we contact you soon...');
        		 redirect('page/contact');
       
	
	}
}
}

	public  function how_it_works()
	{
		$data =array();
		$theme = $this->session->userdata('front_theme');
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/page/howitwork')) {
            $this->load->view('themes/' . $theme . '/template/page/howitwork', $data);
        }else{
            $this->load->view('themes/default/template/page/howitwork', $data);
        }
	}

protected function sendcontactmail($email,$firstname,$lastname,$phone,$msg){
		$email_address = $this->setting->get('email_address');
        $welcome_mail_template = $this->setting->getMail('contactus_email_template');
		$company_name = $this->setting->get('company_name');
        $search  = array('{email}','{firstname}','{lastname}','{phone}','{message}');
        $replace = array($email,$firstname,$lastname,$phone,$msg);
        $message = str_replace($search, $replace, $welcome_mail_template);
        $subject = 'Inquiry By '.$firstname;
        //mail library
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
		$this->email->from($email_address, $companyname);
		$this->email->to($email_address); 
		$this->email->subject($subject);
		$this->email->message($message);	
		//$this->email->send();
	    if($this->email->send()){
   //Success email Sent
   echo $this->email->print_debugger();
    }else{
   //Email Failed To Send
   echo $this->email->print_debugger();
    }

		
	}
	
}	

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */