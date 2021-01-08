<?php

class Gplus extends MX_Controller {

    public function index() {

        if (!class_exists('Google')) {
            require_once(FCPATH . 'system/vendor/Google/autoload.php');
        }
        
        $this->googleObject = new Google_Client();
        
        $this->googleObject->setClientId($this->setting->get('google_client_id'));
        $this->googleObject->setClientSecret($this->setting->get('google_client_secret'));        
        
        $this->googleObject->setRedirectUri('http://localhost/labhchar/gplus/callback');
        $this->googleObject->setScopes(array('https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email'));

        redirect($this->googleObject->createAuthUrl());
    }

    public function callback() {

        if (!class_exists('Google')) {
            require_once(FCPATH . 'system/vendor/Google/autoload.php');
            //require_once(FCPATH . 'library/vendor/google-api/contrib/Google_Oauth2Service.php');
        }
        $this->googleObject = new Google_Client();

        $this->googleObject->setClientId($this->setting->get('google_client_id'));
        $this->googleObject->setClientSecret($this->setting->get('google_client_secret'));  

        $this->googleObject->setRedirectUri('http://localhost/labhchar/gplus/callback');
        $this->googleObject->setScopes(array('https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email'));

        $oauth2 = new Google_Service_Oauth2($this->googleObject);//Google_Oauth2Service

        $salt = $this->setting->get('advancedlogin_gpwdsecret');
        
        if (isset($_GET['code'])) {
            $this->googleObject->authenticate($_GET['code']);
            $token = $this->googleObject->getAccessToken();
        }

        if (isset($token) && isset($oauth2)) {
            $this->googleObject->setAccessToken($token);
            $user = $oauth2->userinfo->get();

            if (empty($user['error'])) {
                if (!$user['verified_email']) {
                    $this->session->set_flashdata('warning', "Error: Google Validation Not Completed Successfully!");
                    redirect('/');
                }
                
                $this->load->model('loginModel');

                $email = $user['email'];
                $salt = (!empty($salt)) ? $salt : 'qwd2asdaej62ad';
                $password = $this->encrypt($user['id'], $salt);

                // 1) Already register with given email  
                $customer_from_db = $this->db->get_where('customer', array('email'=> $email))->row_array();

                //insert to db if not exists
                if($customer_from_db){
                    
                    $customer_id = $customer_from_db['c_id'];
                    
                // 2) register customer 
                } else {

                    $this->request->post['email'] = $email;

                    $customer_info = array(
                        'first_name' => isset($user['given_name']) ? $user['given_name'] : '',
                        'last_name' => isset($user['family_name']) ? $user['family_name'] : '',
                        'email' => $user['email'],
                        'phone' => '',
                        'password' => time(),
                        'created_on' => date('Y-m-d H:i:s'),
                        'enabled' => '1'
                    );
                    
                    $customer_id = $this->loginModel->insert($customer_info);
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
        
        $this->session->set_flashdata('warning', "Error: Google Validation Not Completed Successfully!");
        redirect('/');
    }

    function encrypt($text, $salt) {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function decrypt($text, $salt) {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    function htmlspecialcharsDecode($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[$this->htmlspecialcharsDecode($key)] = $this->htmlspecialcharsDecode($value);
            }
        } else {
            $data = htmlspecialchars_decode($data, ENT_COMPAT);
        }

        return $data;
    }    
}
