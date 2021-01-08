<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Header extends MX_Controller {
public $user = "";
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('header_model', 'loginModel');
		
	}

	public function index()
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

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header')) {
			$this->load->view('themes/' . $theme . '/template/common/header', $data);
		}else{
			$this->load->view('themes/default/template/common/header', $data);
		}
	}
	
	public function blog()
	{
		$data = array();
		//load view 
		$data['blog_cat'] = $this->loginModel->getcategorry();
		$theme = $this->session->userdata('front_theme');
		
		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header-blog')) {
			$this->load->view('themes/' . $theme . '/template/common/header-blog', $data);
		} else {
			$this->load->view('themes/default/template/common/header-blog', $data);
		}
	}
	
	public function blogmob()
	{
		$data = array();
		//load view 
		$data['blog_cat'] = $this->loginModel->getcategorry();
		$theme = $this->session->userdata('front_theme');
		
		

		if (file_exists(APPPATH . 'views/themes/' . $theme . '/template/common/header-blogm')) {
			$this->load->view('themes/' . $theme . '/template/common/header-blogm', $data);
		} else {
			$this->load->view('themes/default/template/common/header-blogm', $data);
		}
	}
	
	
	
}


/* End of file Header.php */
/* Location: ./application/controllers/Header.php */