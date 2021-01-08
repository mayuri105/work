<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->helper('language');
		
	}

	public function index()
	{	
		$data =array();

		$theme = $this->session->userdata('front_theme');
       	
        if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/users/login')) {
            $this->load->view('themes/' . $theme . '/template/users/login', $data);
        }else{
            $this->load->view('themes/default/template/users/login', $data);
        }
        
	}

	public function validateLogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);

        }else{
	       	$data  = array('email' => post('email'),'password'=>post('password'));
     	
			$ret = $this->loginModel->validate($data);
			if($ret){

    			$return = array('response'=>1);
            	echo json_encode($return);
        	}else{
	        	
	          	$return = array('error'=>'The username or password was incorrect. Please try again or reset your password.','response'=>0);

            	echo json_encode($return);
		    }
        	
        	
        }
	}

	public function signup(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sigemail', 'email', 'required|valid_email|is_unique[customer.email]');
        $this->form_validation->set_rules('signup_pass', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('firstname', 'firstname', 'required|min_length[3]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|min_length[3]');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);

        }else{
        	$slug = post('firstname').post('lastname'); 

        	$i = 1; $baseSlug = $slug;
			while($this->ref_exist($slug)){
			    $slug = $baseSlug.$i++;        
			}

			$share_code =  $slug;
			
			if ($this->session->ref_code) {
				$ref_code = $this->session->ref_code;
			}else{
				$ref_code =null;
			}

        	$password = $this->encrypt->encode(post('signup_pass'));
	       	$data  = array(
	       		'first_name' => post('firstname'),
	       		'last_name'=>post('lastname'),
	       		'email'=>post('sigemail'),
	       		'password'=>$password,
	       		'created_on'=>date('Y-m-d H:i:s'),
	       		'last_login'=>date('Y-m-d H:i:s'),
	       		'ref_by'=>$ref_code,
	       		'share_code'=>strtolower($share_code),
	       		'enabled'=>'1'
	       	);
     	
			$ret = $this->loginModel->insert($data);
			if($ret){
				$this->session->unset_userdata('ref_code');
				$to_mail = post('sigemail');
				$username = post('first_name').' '.post('lastname');
				$this->sendSignUpmail($to_mail,$username);
    			$return = array('response'=>1,'success'=>'Users is successfully created please login.');
            	echo json_encode($return);
        	}else{
	        	
	          	$return = array('error'=>'The username or password was incorrect. Please try again or reset your password.','response'=>0);

            	echo json_encode($return);
		    }
        	
        	
        }

	}

	public function forgetpassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      

        if ($this->form_validation->run() == FALSE){
            $return = array('error'=>validation_errors(),'response'=>0);
            echo json_encode($return);
            
        }else{
	       	$data  = array('email' => post('email'));
        	$user = $this->loginModel->getpassword($data);

			if($user){
				$username = $user->first_name.' '.$user->last_name;
				$user_mail_address = $user->email;
				
				$pwd = $user->password;
                $decypted_pwd = $this->encrypt->decode($user->password);
                
                $phone = $user->phone;	
                $this->sendmail($user_mail_address,$username,$decypted_pwd );
				$this->session->set_flashdata('success','Password sent msg');


				$sms_enabled = $this->setting->get('sms_enabled');
					if ($sms_enabled) {

						$isMsgEnabled = $this->setting->isMsgEnabled('customer_forgott_mail_template');
						$forgott_msg = $this->setting->getMsg('customer_forgott_mail_template');
						
						$company_name = $this->setting->get('site_name');
						$search  = array('{company_name}','{username}','{password}');

				        $replace = array($company_name, $username, $decypted_pwd);
				        $message = str_replace($search, $replace, $forgott_msg);


						if ($isMsgEnabled) {
							$this->load->helper('twilio');
							$sid = $this->setting->get('twilio_sid');
							$token = $this->setting->get('twilio_auth_token');
							$twilio_messaging_service_sid = $this->setting->get('twilio_messaging_service_sid');
							$service = get_twilio_service($sid, $token);

							if ($phone) {
								$phoneNo = '+'.$phone;
								$sms =  $service->account->messages->create(array(
									'To' => $phoneNo,
									'MessagingServiceSid' =>$twilio_messaging_service_sid,
									'Body' =>$message,
								));
							}
							
						}	
					}
					
				$return = array('response'=>1,'msg'=>'We sent a password to your email address.');
            	echo json_encode($return);
			}else{
				$return = array('msg'=>'No account found for customer id'.post('email'));
				echo json_encode($return);
			}

        }

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

	protected function sendSignUpmail($to,$username){
		$email_address = $this->setting->get('email_address');
        $welcome_mail_template = $this->setting->getMail('customer_welcome_mail');
    	$company_name = $this->setting->get('site_name');
        $search  = array('{company_name}','{username}');
        $replace = array($company_name, $username);
        $message = str_replace($search, $replace, $welcome_mail_template);
        $subject = 'Worm welcome on '.$company_name;
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
	
	function ref_exist($x){
		
		$this->db->where('share_code',$x);

		$ret = $this->db->get('customer');

		if($ret->row()){
			return true;
		}else{
			return false;
		}

	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */