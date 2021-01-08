<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb_model extends CI_Model{
    
    public function __construct(){
        $this->load->library('encrypt');
        $this->load->model('loginModel');
        $this->load->helper('url');
    }
    
    public function save_fb_data($data){

        $pw = time();
        $password = $this->encrypt->encode($pw);

        $customer_info = array(
            'first_name' => $data['first_name'],
            'last_name' =>  $data['las_name'], 
            'email' => $data['email'],
            'phone' => '',
            'password' => $password,
            'created_on' => date('Y-m-d H:i:s'),
            'enabled' => '1'
        );
       
        return $this->loginModel->insert($customer_info);
    }
}