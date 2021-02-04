<?php

/**
 * Function Name
 *
 * Function description
 *
 * @access	public
 * @param	type	name
 * @return	type
 */

if (!function_exists('prd')) {

	function prd($var) {
		echo '<pre>';
		if (is_array($var)) {
			print_r($var);
			die;
		} else {
			var_dump($var);
			die;
		}
		echo '</pre>';
	}

}

if (!function_exists('post')) {

	function post($var) {

		$CI = &get_instance();
		if ($var) {
			return $CI->input->post($var);
		} else {
			return $CI->input->post();
		}
	}

}

if ((!function_exists('is_login'))) {

	function is_login() {
		$CI = &get_instance();
		$is_login = $CI->session->userdata('is_login');

		return $is_login;
	}
}

function getSiteSetting() {
	$CI = &get_instance();
	$ret = $CI->db->get('settings')->result();
	return $ret;
}
function getstate() {
	$CI = &get_instance();
	$ret = $CI->db->get('state')->result();
	return $ret;
}

function format_telephone($phone_number) {
	$matches = array();
	$cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
	preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
	return "({$matches[1]}) {$matches[2]}-{$matches[3]}";
}

function FormatCreditCard($cc) {
	// REMOVE EXTRA DATA IF ANY
	$cc = str_replace(array('-', ' '), '', $cc);
	// GET THE CREDIT CARD LENGTH
	$cc_length = strlen($cc);
	$newCreditCard = substr($cc, -4);
	for ($i = $cc_length - 5; $i >= 0; $i--) {
		// ADDS HYPHEN HERE
		if ((($i + 1) - $cc_length) % 4 == 0) {
			$newCreditCard = '-' . $newCreditCard;
		}
		$newCreditCard = $cc[$i] . $newCreditCard;
	}
	// REPLACE CHARACTERS WITH X EXCEPT FIRST FOUR AND LAST FOUR
	for ($i = 4; $i < $cc_length - 4; $i++) {
		if ('-' == $newCreditCard[$i]) {
			continue;
		}
		$newCreditCard[$i] = 'X';
	}
	// RETURN THE FINAL FORMATED AND MASKED CREDIT CARD NO
	return $newCreditCard;
}

function cardType($number) {
	$number = preg_replace('/[^\d]/', '', $number);
	if (preg_match('/^3[47][0-9]{13}$/', $number)) {
		return 'amex';
	} elseif (preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/', $number)) {
		return 'discover';
	} elseif (preg_match('/^5[1-5][0-9]{14}$/', $number)) {
		return 'mastercard';
	} elseif (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $number)) {
		return 'visa';
	} else {
		return 'Unknown';
	}
}

function cleanstring($str) {
	// $str2 = str_replace('_', ' ', $str);
	// $str2 = str_replace('-', ' ', $str);
	// $str3 = filter_var($str2, FILTER_SANITIZE_STRING);
	// return $str3;

	$string = str_replace('-', ' ', $str); // Replaces all spaces with hyphens.

	return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);

}

function getuploadpath() {
	return $upload_path = base_url() . 'upload/';
}

function create_time_range($start, $end, $by = '30 mins') {
	$start_time = strtotime($start);
	$end_time = strtotime($end);
	$current = time();
	$add_time = strtotime('+' . $by, $current);
	$diff = $add_time - $current;
	$times = array();
	while ($start_time < $end_time) {
		$times[] = $start_time;
		$start_time += $diff;
	}
	$times[] = $start_time;
	return $times;

}

function json_decode_multi($s, $assoc = false, $depth = 512, $options = 0) {
	if (substr($s, -1) == ',') {
		$s = substr($s, 0, -1);
	}

	return json_decode("[$s]", $assoc, $depth, $options);
}

function getActiveCustomerInfo() {

	$CI = &get_instance();
	$cid = $CI->session->userdata('c_id');
	$CI->db->where('c_id', $cid, FALSE);
	$ret = $CI->db->get('customer')->row();
	return $ret;
}

function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 