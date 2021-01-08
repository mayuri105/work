<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		
		$this->load->helper('url');
	}

	public function index()
	{	
		
		$data =array();

		$theme = $this->session->userdata('front_theme');
       	
       	$data['title'] = $this->setting->get('site_name');
		$data['meta_descriptions'] = $this->setting->get('meta_descriptions');
		$data['meta_keywords'] = $this->setting->get('meta_keywords');
		$data['meta_titles'] = $this->setting->get('meta_titles');
		
		$data['google_api_client_id'] = $this->setting->get('google_api_client_id');
		$data['facebook_app_id'] = $this->setting->get('facebook_app_id');
		
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/login')) {
            $this->load->view('themes/' . $theme . '/template/users/login', $data);
        }else{
            $this->load->view('themes/default/template/users/login', $data);
        }
        
	}

	
	public function validateLoginJs()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userName', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE){
        	$return  = array('Type'=> 'error', 'Message' =>validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
	       	$data  = array('email' => post('userName'),'password'=>post('password'));
			$ret = $this->loginModel->validate($data);
			
			if($ret){
				$return  = array('n' =>'1','Type'=> 'Success', 'Message' =>'Login Successfully');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
        	}else{
        		$return  = array('Type'=> 'error', 'Message' =>'Email And Password Does not Match', );
        		$this->output->set_content_type('application/json')->set_output(json_encode($return));
		    }
        	
        	
        }
	}
	public function signupjs(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[customer.email]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]');
		$this->form_validation->set_rules('phone', 'phone', 'required|is_numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('repassword', 'Confirm password', 'required|matches[password]');
		if($this->form_validation->run() == FALSE){
       		$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
        		$pw = post('password');
	        	$password = $this->encrypt->encode($pw);

		       	$data  = array(
		       		'first_name'=>post('first_name'),
		       		'email' => post('email'),
		       		'phone' => post('phone'),
		       		'password'=>$password,
		       		'created_on'=>date('Y-m-d H:i:s'),
		       		'enabled'=>'1'
		       	);
				$ret = $this->loginModel->insert($data);
				
				$dat2  = array(
					'c_id' =>$ret,
					'is_login'=>1,
					'is_admin'=>0,
					);
				$this->session->set_userdata($dat2);
				$return = array('n'=>1,'Type'=>'Success','Message'=>'Your Account Successfully Created');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));

        }

	}
	
	public function forgetpw(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
       
		if($this->form_validation->run() == FALSE){
			$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
		}else{
			$userName = post('email');
			$getCustomer = $this->loginModel->checkuser($userName);

			if ($getCustomer) {
				$pw = $this->encrypt->decode($getCustomer->password);
				$mobile = $getCustomer->phone;
				
				$to = $getCustomer->email;
				$username = $getCustomer->email;
				$this->sendmail($to,$username,$pw);
				$this->sendPassword($username,$mobile,$pw);

				$return = array('Success'=>true,'Message'=>'We send you password on your mobile & Email');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
			}else{
				$return = array('Error'=>false,'Message'=>'No user found..Please try login instead');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
			}
		}	
		

	}

	protected function sendPassword($username,$mobile,$decypted_pwd){
		$company_name = $this->setting->get('site_name');
		$forgott_msg_template = $this->setting->getMsg('customer_forgott_mail_template');
		$search  = array('{company_name}','{username}','{password}');
        $replace = array($company_name, $username, $decypted_pwd, '');
        $message = str_replace($search, $replace, $forgott_msg_template);
        send_msg($mobile,$message);
	}

	protected function sendmail($to,$username,$decypted_pwd){
		$email_address = $this->setting->get('email_address');
        $forgott_mail_template = $this->setting->getMail('customer_forgott_mail_template');
    	$company_name = $this->setting->get('site_name');
        $search  = array('{company_name}','{username}','{password}','{login_page_link}');
        $replace = array($company_name, $username, $decypted_pwd, '<a href="'.base_url().'users/login">Login</a>');
        $message = str_replace($search, $replace, $forgott_mail_template);
        $subject = 'Password for "'.$company_name.'"';
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
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		return true;		
	}


	public function logout(){

		$this->session->sess_destroy();
		redirect('/');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */