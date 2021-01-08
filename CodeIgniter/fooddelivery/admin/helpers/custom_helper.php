<?php 
function prd($var){
	echo '<pre>';
	if(is_array($var)) {
		print_r($var);
		die;
	} else {
		var_dump($var);
		die;
	}
	echo '</pre>';
}
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
// check user have access rights or not
function checkRights(){
	$CI =& get_instance();

	$is_login = $CI->session->userdata('is_admin');
	if($is_login){
		$user_group_id =  $CI->session->userdata('user_group_id');
		$CI->db->where('group_id',$user_group_id);
		$group = $CI->db->get('user_group')->row();
		$class = $CI->router->fetch_class();
		if(in_array( ucfirst($class),json_decode($group->permission))){
			return true;
		}else{
			return false;
		}   
	}else{
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

// get sites all setting any where in application
function getSiteSetting(){
	$CI =& get_instance();
	$ret = $CI->db->get('settings')->result();
	return $ret;
}
// get states 
function getstate(){
	$CI =& get_instance();
	$ret = $CI->db->get('state')->result();
	return $ret;
}
// check merchant is login or not
function checkmerchant(){
		$CI =& get_instance();
		if($CI->session->userdata('is_merchant')){
			return true;
		}else{
			return false;
		}
}
// encoding url 
function encode_url($string, $key="", $url_safe=TRUE){
	if($key==null || $key=="")
	{
			$key="defaulturlencryption";
	}
	$CI =& get_instance();
	$CI->load->library('encrypt');
	$ret = $CI->encrypt->encode($string, $key);

	if ($url_safe)
	{
			$ret = strtr(
							$ret,
							array(
									'+' => '.',
									'=' => '-',
									'/' => '~'
							)
					);
	}

	return $ret;
}
// decoding url
function decode_url($string, $key=""){

	if($key==null || $key==""){
			$key="defaulturlencryption";
		}
		$CI =& get_instance();
		$CI->load->library('encrypt');  
			$string = strtr(
						$string,
						array(
								'.' => '+',
								'-' => '=',
								'~' => '/'
						)
				);

		return $CI->encrypt->decode($string, $key);
}

if (!function_exists('set_value')) {
    function set_value($field = '', $default = '') {
            $OBJ = & _get_validation_object();

            if ($OBJ === TRUE && isset($OBJ->_field_data[$field])) {
                    return form_prep($OBJ->set_value($field, $default));
            } else {
                    if (!isset($_POST[$field])) {
                            return $default;
                    }
                    return form_prep($_POST[$field]);
            }
    }
}


function addactivity($actstring){
	$CI =& get_instance();
	$dataActivity = array(
		'user_id'=>$CI->session->u_id,
		'act_key'=>$actstring,
	);
	$CI->db->insert('user_activity',$dataActivity);
}

function getuploadpath() {
	return $upload_path = site_url(''). '../upload/';
}