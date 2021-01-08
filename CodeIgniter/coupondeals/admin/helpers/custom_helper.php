<?php 

function post($var){
	$CI =& get_instance();
	if($var) {
		 return $CI->input->post($var);
	}else{
	return $CI->input->post();
	}
}
function is_login(){
	$CI =& get_instance();
	$is_login = $CI->session->userdata('is_admin');
	if(!$is_login){
		$url = current_url();
		$CI->session->set_userdata('referer_url', $url);
		redirect('login');
	}
}

function checkModification(){
	$CI =& get_instance();
	$user_group_id =  $CI->session->userdata('user_group_id');
	$CI->db->where('group_id',$user_group_id);
	$group = $CI->db->get('user_group')->row();
	$class = $CI->router->fetch_class();
	if(in_array( ucfirst($class),json_decode($group->modify))){
		return true;
	}else{
		return false;
	}    
		
}
function getLocation($value=''){
	$CI =& get_instance();
	$query=  $CI->db->get('location')->result();
	return $query;	 	
 }

// get sites all setting any where in application
function getSiteSetting(){
	$CI =& get_instance();
	$ret = $CI->db->get('settings')->result();
	return $ret;
}
function getuploadpath() {
	return $upload_path = site_url(''). '../upload/';
}


function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

function addactivty($actstring){
	$CI =& get_instance();
	$dataActivity = array(
		'user_id'=>$CI->session->u_id,
		'act_key'=>$actstring,
	);
	$CI->db->insert('user_activity',$dataActivity);
}

function operationPr($operation,$op1,$op2){
   switch ($operation){
    case '+':
        return $op1 + $op2;
        break;
    case '-':
        return $op1 - $op2;
        break;
    }
}