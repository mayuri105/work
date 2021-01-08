<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  error_reporting(0);
  
  class Login extends MX_Controller {
  
  
  
	public function __construct()
  
	{
  
		parent::__construct();
  
		$this->load->model('Login_model');
  
		$this->load->library('session');
  
		$this->load->helper('form');
  
	}
  
  
  
	public function index()
  
	{	
  
  
  
		$data =array();
  
		
  
		$theme = $this->session->userdata('admin_theme');
  
	   
  
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/home/login')) {
  
			$this->load->view('themes/' . $theme . '/template/home/login', $data);
  
		}else{
  
			$this->load->view('themes/default/template/home/login', $data);
  
		}
  
																																							   
  
	}
  
  
  
	public function validateLogin()
  
	{
  
		$this->load->library('form_validation');
  
		$this->form_validation->set_rules('username', 'Username', 'required');
  
		$this->form_validation->set_rules('password', 'Password', 'required');
  
  
  
		//session_start();
  
		
		
  
		if ($this->form_validation->run() == FALSE){
  
			$this->session->set_flashdata('error', validation_errors());
  
			redirect('login');
  
		}else{
  
  
  
			$data  = array('username' => post('username'),'password'=>md5(post('password')));
  
			$ret = $this->Login_model->validate($data);
			if($ret){
			redirect('home');	
			}else
			{
			$this->session->set_flashdata('error','invalid username or password');
				redirect('login');    
			}
  
			}       	
  
		}
  

  

	
  

  
	
  public function forgotpassword(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('femail', 'email', 'required|valid_email');
       
		if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				 redirect('login/index');
		}else{
			
			$user_email = post('femail');
			$ret = $this->Login_model->checkuser($user_email);
			//print_r($ret);
			//die;

			if ($ret) {
				
				$dataf['FirstName'] = $this->Login_model->checkuser($user_email);
				$datal['LastName'] = $this->Login_model->checkuser($user_email);
    			$FirstName=$dataf['FirstName']->FirstName;
				$LastName=$datal['LastName']->LastName;
				//echo $FirstName;
				//die;
				$dataui['UniqueId'] = $this->Login_model->checkuser($user_email);
    			$UniqueId=$dataui['UniqueId']->UniqueId;
				
    			$institute_name=$datai['institute']->Name;
				$reset_password_link = $this->defaultsetting->get('site_url')."/resetpassword?key=".$UniqueId;
				//echo $reset_password_link;
				//die;
				$sendto=$this->sendforgotmail($user_email,$FirstName,$LastName,$reset_password_link);
				if($sendto){	
			$this->session->set_flashdata('success','Reset Password Link send  Check Your Inbox');
        	redirect('login/index');
				}
		}
		else{
				$this->session->set_flashdata('error','please confirm your email');
				redirect('login');
			}	
		

		}
		}
	
  public function resetpassword() {
	
		$data = array();
		$data['UniqueId'] = $_GET['key'];
		
		$theme = $this->session->userdata('front_theme');
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/home/reset')) {
			$this->load->view('themes/' . $theme . '/template/home/reset',$data);
		} else {
			$this->load->view('themes/default/template/home/reset',$data);
		}
	}
		 function updatepassword() {
			
		$this->load->library('form_validation');
		
		 $this->form_validation->set_rules('PasswordHash', 'password', 'trim|required|min_length[5]');
	
        $this->form_validation->set_rules('cPasswordHash', 'Confirm password', 'trim|required|matches[PasswordHash]');
		
			
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				
				redirect('resetpassword');
			} else {
				$data = $this->input->post();
				$UniqueId  = $data['UniqueId'];
				$this->Login_model->updatepass($data);
        		$this->session->set_flashdata('success', ' Successfully Updated');
        		redirect('login');

			}
		
	}
	function logout(){
  
		$this->session->sess_destroy();
  
		redirect('login');
  
	}
  
  
  
	function account(){
  
		$data =array();
  
		
  
		
  
		//print_r($data);
  
		//die;
  
		$theme = $this->session->userdata('admin_theme');
  
	   
  
		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/home/account')) {
  
			$this->load->view('themes/' . $theme . '/template/home/account', $data);
  
		}else{
  
			$this->load->view('themes/default/template/home/account', $data);
  
		}
  
	}
  
  
  
	function update_account(){
  
		$this->load->library('form_validation');
  
		$this->form_validation->set_rules('frist_name', 'FirstName', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('last_name', 'LastName', 'required|min_length[2]|max_length[30]');
  
		$this->form_validation->set_rules('email', 'Email', 'required');
  
	   
  
  
  
		
  
		if ($this->form_validation->run() == FALSE){
  
			$this->session->set_flashdata('error', validation_errors());
  
			redirect('login/account');
  
		}else{
  
			
  
			$data= array(
  
			
  
				'first_name'=>post('first_name'),
  				'last_name'=>post('last_name'),
				
  
				'email'=>post('email'),
  
				
  
				
  
				
  
			);	
  
			$where = array('u_id'=>post('u_id'));
  
			$ret = $this->Login_model->update($data,$where);
  
				
  
				
  
			$this->session->set_flashdata('success','Account Updated');
  
			redirect('login/account/'.post('applicationuser').'');
  
		}
  
		 
  
	}
  
	
  
	function changepassword(){
  
		$this->load->library('form_validation');
  
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|min_length[3]');
  
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[3]');
  
		$this->form_validation->set_rules('confpassword', 'Confirm Password', 'required|min_length[3]');
  
		
  
		if ($this->form_validation->run() == FALSE){
  
			$this->session->set_flashdata('error', validation_errors());
  
			redirect('login/account/'.post('applicationuser').'');
  
		}else{
  
			$data= array(
  
				'email'=>post('applicationuser_email'),
  
			);	
  
			
  
			$query = $this->Login_model->getoldpassword($data);
  
			//print_r($query);
  
			//die;
  
			if($query == md5(post('oldpassword'))){
  
				$data= array(					
  
					'PasswordHash'=>md5(post('newpassword')),					
  
				);	
  
				$where = array('email'=>post('applicationuser_email'));
  
				$ret = $this->Login_model->updatepassword($data,$where);	
  
				$this->session->set_flashdata('success','Password has been changed');
  
				redirect('login/account/'.post('applicationuser').'');	
  
			}else{
  
				$this->session->set_flashdata('error','Old password not match');
  
				redirect('login/account/'.post('applicationuser').'');
  
			}
  
			
  
		}
  
		
  
		
  
	}
	
	
	protected function sendforgotmail($user_email,$FirstName,$LastName,$reset_password_link){
		$email_address = $this->defaultsetting->get('email_address');
        $forgotpw_mail_template = $this->defaultsetting->getMail('User_forgotpassword_mail_template');
		
		
        $search  = array('{FirstName}','{LastName}','{reset_password_link}');
        $replace = array($FirstName,$LastName,$reset_password_link);
        $message = str_replace($search, $replace, $forgotpw_mail_template);
        $subject = 'Reset Password';
        //mail library
        $this->load->library('email');
        $config['protocol']     = $this->defaultsetting->get('mail_protocol');//'smtp';
        $config['smtp_host']    = $this->defaultsetting->get('smtp_host');//'ssl://smtp.gmail.com';
        $config['smtp_port']    = $this->defaultsetting->get('smtp_port');//'465';
        $config['smtp_timeout'] = $this->defaultsetting->get('smtp_timeout');//'7';
        $config['smtp_user']    = $this->defaultsetting->get('smtp_user');//'mygmail@gmail.com';
        $config['smtp_pass']    = $this->defaultsetting->get('smtp_pass');
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html';
        $this->email->initialize($config);

		$this->email->from($email_address);
		$this->email->to($user_email); 

		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		return 1;		
	}
	 
  }
  
  
  
  /* End of file Login.php */
  
  /* Location: ./application/controllers/Login.php */