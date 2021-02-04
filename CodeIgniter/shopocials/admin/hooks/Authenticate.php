<?php

class Authenticate
{
    function index() {
        
        $ci =& get_instance();
        
        $route = $ci->router->fetch_class().'/'.$ci->router->fetch_method();  
            
        $is_admin_login = $ci->session->userdata('is_admin');
        $is_merchant = $ci->session->userdata('is_merchant');
        //if not login 
        if (!$is_admin_login && !$is_merchant  && $route!='login/index' && $route!='login/forgetpassword'  && $route!='login/submitforget'  && $route!='login/validateLogin' ) {
            redirect('login/');
        }

        $restricted = $ci->config->item('restricted');
        $controller_name = $ci->router->fetch_class();
        
        if($is_merchant && $route!='login/logout' && in_array($controller_name, $restricted)){
            redirect('login/');
        }
    }
    function force_ssl()
  {
    $CI =& get_instance();
    $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
    if ($_SERVER['SERVER_PORT'] != 443) redirect($CI->uri->uri_string());
  }
}