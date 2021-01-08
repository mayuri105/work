<?php







if ( !function_exists( 'post' ) ) {



	function post( $var ) {



		$CI = &get_instance();

		if ( $var ) {

			return $CI->input->post( $var );

		} else {

			return $CI->input->post();

		}

	}



}



if ( ( !function_exists( 'is_login' ) ) ) {



	function is_login() {

		$CI = &get_instance();

		$is_login = $CI->session->userdata( 'is_login' );

		

		return $is_login;

	}

}



function getSiteSetting() {

	$CI = &get_instance();

	$ret = $CI->db->get( 'settings' )->result();

	return $ret;

}


function checkModification(){
	$CI =& get_instance();
	$user_group_id =  $CI->session->userdata('user_group_id');
//	echo $user_group_id ;die;
	$CI->db->where('group_id',$user_group_id);
	$group = $CI->db->get('user_group')->row();
	$class = $CI->router->fetch_class();
	if(in_array( ucfirst($class),json_decode($group->modify))){
		return true;
	}else{
		return false;
	}    
		
}


function getuploadpath() {

	return $upload_path = base_url() . 'upload/';

}







