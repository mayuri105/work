<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     link<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php
 *          replace (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_links($string,$replace_with)
{
	$arr_wildchar = array("`","~","!","%","^","*","(",")","{","}"," ",":", );
	if (!in_array($string, $arr_wildchar)) 
	{
		$new_string = str_replace($arr_wildchar, $replace_with, $string);
	}
	return strtolower($new_string);
    //return str_replace($search, $replace, $string);
}

/* vim: set expandtab: */

?>
