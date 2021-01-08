<?php

class Authenticate
{
    function index() {
        
        
        $ci =& get_instance();
        
        $route = $ci->router->fetch_class().'/'.$ci->router->fetch_method();  
            
        $is_admin_login = $ci->session->userdata('logged_in');
        //if not login 
        if (!$is_admin_login && $route!='login/index' && $route!='login/forgetpassword'  && $route!='login/submitforget'  && $route!='login/validateLogin' ) {
            redirect('login/');
        }
     }
}