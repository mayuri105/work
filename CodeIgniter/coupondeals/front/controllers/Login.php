<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->helper('language');
		//$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->helper('url');
		
	
	}

	
public function fblogin()
	{
			 $this->load->library('facebook', array(
            'appId' => $this->setting->get('fb_app_id'),
            'secret' => $this->setting->get('secret'),
        ));

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {           
            
            $logout_url = site_url('login/logout');//'http://krushn/labhchar/fb/logout
             $userProfile = $facebook->api('/me');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['username'] = $userProfile['first_name']. " ".$userProfile['last_name'];
           
            $userData['email'] = $userProfile['email'];
            // Insert or update user data
            $userID = $this->loginModel->checkUser($userData);
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
                 
            
        } else {
            
            $login_url = site_url('login/fblogin');//'http://krushn/labhchar/fb/login';//
            
            redirect($this->facebook->getLoginUrl(array(
                'redirect_uri' => $login_url,
                'scope' => array("email") // permissions here
            )));
        }
      
	  
	 
	}

	
	
public function validateLoginJs()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE){
        	$return  = array('Type'=> 'error', 'Message' =>validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
	       	$data  = array('email' => post('email'),'password'=>md5(post('password')));
			$ret = $this->loginModel->validate($data);
			
			if($ret){
				$return  = array('n' =>'1','Type'=> 'Success', 'Message' =>'Login Successfully');
				//redirect('home');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
        	}else{
        		$return  = array('Type'=> 'error', 'Message' =>'Email And Password Does not Match', );
        		$this->output->set_content_type('application/json')->set_output(json_encode($return));
		    }
        	
        	
        }
	}
	public function signupjs(){
		$this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('username', 'username', 'required');
           $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_users.email]'); 
             $this->form_validation->set_rules('password', 'password', 'required|matches[cpassword]'); 
			  $this->form_validation->set_rules('cpassword', 'confirm', 'required'); 
               $this->form_validation->set_rules('agree', 'agree', 'required'); 
		if($this->form_validation->run() == FALSE){
       		$return = array('Type'=>'Error','Message'=> validation_errors());
            $this->output->set_content_type('application/json')->set_output(json_encode($return));
        }else{
        		
		       $admin_email=$this->setting->get('email_address');
		$user_email=post('email');
		$data = array(
					'username' => post('username'),
					'email' => post('email'),
					'password' =>md5(post('password')),
					
					
				);
				$ret = $this->loginModel->insert($data);
				$return = array('n'=>1,'Type'=>'Success','Message'=>'Your Account Successfully Created');
				$this->output->set_content_type('application/json')->set_output(json_encode($return));
				/*$this->load->library('email');
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

					$this->email->from($admin_email);
					$this->email->to($user_email);
					
					$this->email->subject('Welcome To Svaetakatak');
					$msg = $this->load->view('themes/default/template/emailtemp/reguser', $data,TRUE);
					$this->email->message($msg);
					$this->email->send();*/
					

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
	
	public function logout(){
 $this->load->library('facebook');
  $this->session->unset_userdata($userdata);
   $this->facebook->destroysession();
		$this->session->sess_destroy();
		redirect('/');
	}
	
	
public function moblogin()
	{
		 include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
		
		// Google Project API Credentials
		$clientId = '926833537000-ln6g75hofq1dnjkivdff5k4h1076luu5.apps.googleusercontent.com';
        $clientSecret = 'oVGr7-SKaNuMPcSM1Pjph6io';
        $redirectUrlg = 'http://savetakatak.com/';
		
		// Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to savetakatak.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrlg);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

      if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrlg);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }


        if ($gClient->getAccessToken()) {
			 
            $userProfile = $google_oauthV2->userinfo->get();
         
			$userdata['oauth_provider'] = 'google';
			$userdata['oauth_uid'] = $userProfile['id'];
            $userdata['username'] = $userProfile['given_name']. " " .$userProfile['family_name'];
          
            $userdata['email'] = $userProfile['email'];
			
            $userID = $this->loginModel->checkUser($userdata);
          if(!empty($userID)){
                $data['userdata'] = $userdata;
               // $this->session->set_userdata('userdata',$userdata);
			   $this->session->set_userdata($userdata);
            } else {
               $data['userdata'] = array();
            }
        } else {
            $data['authUrl'] = $gClient->createAuthUrl();
        }
	  
		
		$theme = $this->session->userdata('front_theme');
		
		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/mob/login')) {
			$this->load->view('themes/' . $theme . '/template/common/mob/login', $data);
		} else {
			$this->load->view('themes/default/template/common/mob/login', $data);
		}
	}	
	
	public function mobsignup()
	{
		 include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
		
		// Google Project API Credentials
		$clientId = '926833537000-ln6g75hofq1dnjkivdff5k4h1076luu5.apps.googleusercontent.com';
        $clientSecret = 'oVGr7-SKaNuMPcSM1Pjph6io';
        $redirectUrlg = 'http://savetakatak.com';
		
		// Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to savetakatak.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrlg);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

      if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrlg);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }


        if ($gClient->getAccessToken()) {
			 
            $userProfile = $google_oauthV2->userinfo->get();
         
			$userdata['oauth_provider'] = 'google';
			$userdata['oauth_uid'] = $userProfile['id'];
            $userdata['username'] = $userProfile['given_name']. " " .$userProfile['family_name'];
          
            $userdata['email'] = $userProfile['email'];
			
            $userID = $this->loginModel->checkUser($userdata);
          if(!empty($userID)){
                $data['userdata'] = $userdata;
               // $this->session->set_userdata('userdata',$userdata);
			   $this->session->set_userdata($userdata);
            } else {
               $data['userdata'] = array();
            }
        } else {
            $data['authUrl'] = $gClient->createAuthUrl();
        }
	  
	  
		
		$theme = $this->session->userdata('front_theme');
		
		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/mob/signup')) {
			$this->load->view('themes/' . $theme . '/template/common/mob/signup', $data);
		} else {
			$this->load->view('themes/default/template/common/mob/signup', $data);
		}
	}	
public function loginmob()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors());
            redirect('login/moblogin');
        }else{

        	$data  = array('email' => post('email'),'password'=>md5(post('password')));
			$ret = $this->loginModel->validate($data);
			if($ret){
    			redirect('home');
        	}else{
	        	$this->session->set_flashdata('error','Credentials Not match');
	            redirect('login/moblogin');
	        }
    	
        	
        }
	}
	
	public function signupmob(){
		$this->load->library('form_validation');
			
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('username', 'username', 'required');
           $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_users.email]'); 
             $this->form_validation->set_rules('password', 'password', 'required|matches[cpassword]'); 
			  $this->form_validation->set_rules('cpassword', 'confirm', 'required'); 
               $this->form_validation->set_rules('agree', 'agree', 'required'); 
		if($this->form_validation->run() == FALSE){
       		 $this->session->set_flashdata('error', validation_errors());
            redirect('login/mobsignup');
        }else{
        		
		       $admin_email=$this->setting->get('email_address');
		$user_email=post('email');
		$data = array(
					'username' => post('username'),
					'email' => post('email'),
					'password' =>md5(post('password')),
					
					
				);
				$ret = $this->loginModel->insert($data);
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

					$this->email->from($admin_email);
					$this->email->to($user_email);
					
					$this->email->subject('Welcome To Svaetakatak');
					$msg = $this->load->view('themes/default/template/emailtemp/reguser', $data,TRUE);
					$this->email->message($msg);
					$this->email->send();
				$dat2  = array(
					'user_id' =>$ret,
					'is_login'=>1,
					
					);
				$this->session->set_userdata($dat2);
				
	            redirect('home');

        }

	}
	
	public function fbloginas()
	{
	
	$this->load->library('facebook');
        $user = null;
        $user_profile = null;
 
        // See if there is a user from a cookie
        $user = $this->facebook->getUser();
 
        if ($user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $userProfile = $this->facebook->api('/me');
          } catch (FacebookApiException $e) {
            show_error(print_r($e, TRUE), 500);
          }
        }
 
       
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['username'] = $userProfile['first_name']. " ".$userProfile['last_name'];
           
            $userData['email'] = $userProfile['email'];
            // Insert or update user data
            $userID = $this->user->checkUser($userData);
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
 
        redirect('home');
    }


}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */