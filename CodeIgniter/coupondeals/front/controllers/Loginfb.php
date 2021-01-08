<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginfb extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->helper('language');
		
		$this->load->library('encrypt');
		$this->load->helper('url');
		
		//$this->load->model('LoginModel', 'loginModel');
		$this->load->library('Facebook', array('appId' => '1762991843980515', 'secret' => 'e0a6d66a64445bd7a004695fb05a9d17'));
		//$this->user = $this->facebook->getUser();
	}

	public function index()
	{
			/* $this->load->library('facebook', array(
            'appId' => $this->setting->get('fb_app_id'),
            'secret' => $this->setting->get('secret'),
        ));
*/
//$fbPermissions = 'email';
        $user = $this->facebook->getUser();

       
        if ($user) {
            try {
                $userProfile = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {           
            
            $logout_url = site_url('login/logout');//'http://krushn/labhchar/fb/logout
            // $data['user_profile'] = $this->facebook->api('/me?fields=id,first_name,last_name,email');
			 $userProfile = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
	$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => site_url() .'login/logout'));
		$userdata['oauth_provider'] = 'facebook';
		$userdata['oauth_uid'] = $userProfile['id'];
		$userdata['username'] = $userProfile['first_name']." ".$userProfile['last_name'];
		
		$userdata['email'] = $userProfile['email'];
		 $userID = $this->loginModel->checkUser($userdata);
          if(!empty($userID)){
                $data['userdata'] = $userdata;
               // $this->session->set_userdata('userdata',$userdata);
			   $this->session->set_userdata($userdata);
            } else {
               $data['userdata'] = array();
            }   
				$redirect = $this->session->userdata('redirect');

        if ($redirect) {
            $this->session->unset_userdata('redirect');
            redirect($redirect);                    
        } else {
         redirect('/');
        }       
            
        } else {
            $redirectUrl ='http://savetakatak.com/loginfb';
		$fbPermissions = 'email,publish_stream';
             //$login_url = 'http://prometheantechtest2.online/loginfb';//'http://krushn/labhchar/fb/login';//
            
            redirect( $this->facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>'email')));
        }
      
	  
	 
	}

	  public function save_fb_data($data){
        
        //check db for existanse 
        $customer_from_db = $this->db->get_where('tbl_users', array('oauth_uid'=> $data['oauth_uid']))->row_array();

        //insert to db if not exists
        if(!$customer_from_db){
            $customer_id = $this->loginModel->save_fb_data($data);
        }else{
            $customer_id=  $customer_from_db['user_id'];
        }
        
        //login 
        $dat2 = array(
            'username' => $customer_from_db['username'],
            'user_id' => $customer_from_db['user_id'],
			  'email' => $customer_from_db['email'],
            'is_login' => 1,
        );
        
        $this->session->set_userdata($dat2);

        $redirect = $this->session->userdata('redirect');

        if ($redirect) {
            $this->session->unset_userdata('redirect');
            redirect($redirect);                    
        } else {
            redirect('/');
        }
    }
	


	
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */