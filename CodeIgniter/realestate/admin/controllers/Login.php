<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->helper('language');
		$this->lang->load('users');
		$this->load->library('encrypt');
	}

	public function index()
	{	

		$data =array();
		
		$theme = $this->session->userdata('admin_theme');
       
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/login')) {
            $this->load->view('themes/' . $theme . '/template/users/login', $data);
        }else{
            $this->load->view('themes/default/template/users/login', $data);
        }
                                                                                                                                                               
	}

	public function validateLogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        }else{

        	$data  = array('username' => post('username'),'password'=>post('password'));
			$ret = $this->loginModel->validate($data);
			if($ret){
    			redirect('index');
        	}else{
	        	$this->session->set_flashdata('error','Credentials Not match');
	            redirect('login');
	        }
    	
        	
        }
	}
	function forgetpassword(){

		$data =array();

		$theme = $this->session->userdata('admin_theme');
       
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/forgetpassword')) {
            $this->load->view('themes/' . $theme . '/template/users/forgetpassword', $data);
        }else{
            $this->load->view('themes/default/template/users/forgetpassword', $data);
        }

	}
	function submitforget(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|valid_email');
      

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('login/forgetpassword');
        }else{
	       	$data  = array('email' => post('username'));
        	

				$user = $this->loginModel->getpassword($data);

				if($user){
					$username = $user->username;
					$user_mail_address = $user->email;
					
					$pwd = $user->password;
	                $decypted_pwd = $this->encrypt->decode($pwd);
	                				
	                $this->sendmail($user_mail_address,$username,$decypted_pwd );
					$this->session->set_flashdata('success','password sent msg');
					//echo $this->email->print_debugger();
					redirect('login/forgetpassword');
				}else{
					$this->session->set_flashdata('error', 'Username Not found');
					
            		redirect('login/forgetpassword');
				}

        	
        	
        }
	}
	protected function sendmail($to,$username,$decypted_pwd){
		$email_address = $this->setting->get('email_address');
        $forgott_mail_template = $this->setting->getMail('admin_forgott_mail_template');
    	$company_name = $this->setting->get('site_name');
        $search  = array('{company_name}','{username}','{password}','{login_page_link}');
        $replace = array($company_name, $username, $decypted_pwd, '<a href="'.base_url().'users/login">Login</a>');
        $message = str_replace($search, $replace, $forgott_mail_template);

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

		$this->email->from($email_address, $company_name);
		$this->email->to($to); 
		$this->email->subject('Password for "'.$company_name.'"');
		$this->email->message($message);	
		$this->email->send();
		return true;		
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */