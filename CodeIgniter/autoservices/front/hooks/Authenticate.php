<?php
class Authenticate
{
    function index() {
        
        
        $ci =& get_instance();
        
        $route = $ci->router->fetch_class().'/'.$ci->router->fetch_method();  
      
       $ci->load->library('session');
   
        $is_admin_login = $ci->session->userdata('is_login');
		$Role =  $ci->session->userdata('Role');
        //if not login 
        if (!$is_admin_login && $route!='login/index' && $route!='login/updatepassword'  && $route!='login/forgotpassword' && $route!='login/resetpassword' && $route!='login/sendwork' && $route!='login/validateLogin' ) {
            redirect('login/');
        }
		
		if ( $Role != 'admin' && $route == 'users/instructors') {
 
            // && $route =='users/guardians' && $route =='users/addinstructors' && $route =='users/addstudents'   && $route =='users/addguardians'   
			redirect('my404/');
			
        }
		
		if ( $Role != 'admin' && $route == 'users/guardians') {
 
            // && $route =='users/guardians' && $route =='users/addinstructors' && $route =='users/addstudents'   && $route =='users/addguardians'   
			redirect('my404/');
			
        }
		if ( $Role != 'admin' && $route == 'users/addstudents') {
 
            // && $route =='users/guardians' && $route =='users/addinstructors' && $route =='users/addstudents'   && $route =='users/addguardians'   
			redirect('my404/');
			
        }
		if ( $Role != 'admin' && $route == 'users/addinstructors') {
 
            // && $route =='users/guardians' && $route =='users/addinstructors' && $route =='users/addstudents'   && $route =='users/addguardians'   
			redirect('my404/');
			
        }
		if ( $Role != 'admin' && $route == 'users/addguardians') {
 
            // && $route =='users/guardians' && $route =='users/addinstructors' && $route =='users/addstudents'   && $route =='users/addguardians'   
			redirect('my404/');
			
        }
		
     }
}