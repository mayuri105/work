<?php

class Checkrights
{
    function index() {
        
        $CI =& get_instance();
        $is_login = $CI->session->userdata('is_admin');
        if($is_login){
            $user_group_id =  $CI->session->userdata('user_group_id');
            $CI->db->where('group_id',$user_group_id);
            $group = $CI->db->get('user_group')->row();
            $class = $CI->router->fetch_class();
            if(!in_array( ucfirst($class),json_decode($group->permission)) && $class  !='login' ){
                show_error('You dont have permission for this page', 403);
            }   
        }else{
            //redirect('login','refresh');
        }
    }
}

