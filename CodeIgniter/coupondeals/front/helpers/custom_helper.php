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


function getuploadpath() {
	return $upload_path = base_url() . 'upload/';
}



function getActiveCustomerInfo() {

	$CI = &get_instance();
	$cid = $CI->session->userdata( 'c_id' );
	$CI->db->where( 'c_id', $cid, FALSE );
	$ret = $CI->db->get( 'customer' )->row();
	return $ret;
}

function buy_package() {

	$CI = &get_instance();
	$cid = $CI->session->userdata( 'c_id' );
	$date = date('Y-m-d');
	$CI->db->where('customer_id',$cid,FALSE);
	$CI->db->where('payment_done',1,FALSE);
	$CI->db->where('package_start_date <=', $date);
	$CI->db->where('package_end_date  >=', $date);
	$ret = $CI->db->get('customer_buy_package')->row();
	//echo $CI->db->last_query();
	return $ret;
}

function checkPackage($package_category)
{
	$CI = &get_instance();
	$cid = $CI->session->userdata( 'c_id' );
	$date = date('Y-m-d');
	$CI->db->where('customer_id',$cid,FALSE);
	$CI->db->where('payment_done',1,FALSE);
	$CI->db->where('package_start_date <=', $date);
	$CI->db->where('package_end_date  >=', $date);
	$CI->db->where('customer_buy_package.package_category_id', $package_category);
	$CI->db->join('package_category', 'package_category.package_category_id = customer_buy_package.package_category_id', 'left');
	$ret = $CI->db->get('customer_buy_package')->row();
	//echo $CI->db->last_query();
	return $ret;
}

function convertNumber($n){

	if(!is_numeric($n)) return false;
	//if($n>1000000000000) return round(($n/1000000000000),1).' trillion';
	if($n>9999999) return ($n/10000000).' Crore';
	else if($n>10000) return ($n/100000).' Lakhs';
	else if($n>1000) return ($n/1000).' thousand';
}

function summary($str, $limit=40, $strip = false) {
    $str = ($strip == true)?strip_tags($str):$str;
    if (strlen ($str) > $limit) {
        $str = substr ($str, 0, $limit - 3);
        return (substr ($str, 0, strrpos ($str, ' ')).'...');
    }
    return trim($str);
}

function colorcode($a){
    switch ($a) {
	        case 'pending':
	           $color= 'warning';
	            break;
	        case 'cancle':
	           $color= 'danger';
	            break;
	         case 'on hold':
	           $color= 'warning';
	            break;
	         case 'open':
	           $color= 'success';
	            break;
	         case 'close':
	           $color= 'danger';
	            break;    break;   
	        default:
	           $color= 'warning';
	            break;
	}
	return $color;
}

function send_msg($to,$msg){
        $CI = &get_instance();
        $sender_id = $CI->setting->get('config_sms_sender_id');
        $username  = $CI->setting->get('config_sms_username');
        $password  = $CI->setting->get('config_sms_password');
       	$url= 'http://login.smsgatewayhub.com/smsapi/pushsms.aspx?user='.$username.'&pwd='.$password.'&to='.$to.'&sid='.$sender_id.'&msg='.urlencode($msg).'&fl=0&gwid=2'; 
        
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        //Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        return $resp;
    }