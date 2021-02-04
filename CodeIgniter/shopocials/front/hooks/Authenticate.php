<?php

class Authenticate
{
    function index() {
        
        // $ci =& get_instance();
        
        // $route = $ci->router->fetch_class().'/'.$ci->router->fetch_method();  
            
        // $is_customer_login = $ci->session->userdata('is_login');
        
        // //if not login 
        // if (!$is_customer_login && $route!='login/index' && $route!='login/validateLogin' && $route!='login/signup' $route!='login/forgetpassword'  ) {
        //     redirect('/');
        // }

        // $restricted = $ci->config->item('restricted');
        // $controller_name = $ci->router->fetch_class();
        
        // if($is_merchant && $route!='login/logout' && in_array($controller_name, $restricted)){
        //     show_404();
        // }
    }
    function force_ssl()
  {
    $CI =& get_instance();
    $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
    if ($_SERVER['SERVER_PORT'] != 443) redirect($CI->uri->uri_string());
  }
}