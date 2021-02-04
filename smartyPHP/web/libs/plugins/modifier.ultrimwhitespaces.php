<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     stripslashes<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|stripslashes}
 * @link http://smarty.php.net/manual/en/language.modifier.stripslashes.php
 *          stripslashes (Smarty online manual)
 * @version  1.0
 * @author	 Monte Ohrt <monte@ispi.net>
 * @param string
 * @return string
 */
function smarty_modifier_ultrimwhitespaces($string)
{
	$tempString	=	strtolower($string);
	$tempString	=	str_replace(" ","",$tempString);
    return stripslashes($tempString);
}

/* vim: set expandtab: */

?>
