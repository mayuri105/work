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
