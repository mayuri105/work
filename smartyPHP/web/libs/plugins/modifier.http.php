<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty capitalize modifier plugin
 *
 * Type:     modifier<br>
 * Name:     capitalize<br>
 * Purpose:  capitalize words in the string
 * @link http://smarty.php.net/manual/en/language.modifiers.php#LANGUAGE.MODIFIER.CAPITALIZE
 *      capitalize (Smarty online manual)
 * @param string
 * @return string
 */
function smarty_modifier_http($string)
{
	$cnt	=	substr_count($string,"http://");
	$cnt1	=	substr_count($string,"https://");
	
	if($cnt>0 || $cnt1>0)
		return $string;
	else
		return "http://".$string;
	
}

?>
