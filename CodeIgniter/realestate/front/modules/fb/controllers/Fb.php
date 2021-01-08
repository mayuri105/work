<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('fb_model');
        $this->load->helper('url');
    }
    
    public function login() {

        $this->load->library('facebook', array(
            'appId' => $this->setting->get('fb_app_id'),
            'secret' => $this->setting->get('secret'),
        ));

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->facebook->destroySession();
        }

        if ($user) {           
            
            $logout_url = site_url('fb/logout');//'http://krushn/labhchar/fb/logout
            
            $this->save_fb_data($data['user_profile']);
            $this->session->set_userdata('logout_url', $logout_url); // Logs off application            
            
        } else {
            
            $login_url = site_url('fb/login');//'http://krushn/labhchar/fb/login';//
            
            redirect($this->facebook->getLoginUrl(array(
                'redirect_uri' => $login_url,
                'scope' => array("email") // permissions here
            )));
        }
    }
    
    public function save_fb_data($data){
        
        //check db for existanse 
        $customer_from_db = $this->db->get_where('customer', array('email'=> $data['email']))->row_array();

        //insert to db if not exists
        if(!$customer_from_db){
            $customer_id = $this->fb_model->save_fb_data($data);
        }else{
            $customer_id=  $customer_from_db['c_id'];
        }
        
        //login 
        $dat2 = array(
            'c_id' => $customer_id,
            'is_login' => 1,
            'is_admin' => 0,
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
