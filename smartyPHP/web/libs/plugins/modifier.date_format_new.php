<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
/**
 * Smarty date_format modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     date_format<br>
 * Purpose:  format datestamps via strftime<br>
 * Input:<br>
 *         - string: input date string
 *         - format: strftime format for output
 *         - default_date: default date if $string is empty
 * @link http://smarty.php.net/manual/en/language.modifier.date.format.php
 *          date_format (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string|void
 * @uses smarty_make_timestamp()
 */
function smarty_modifier_date_format_new($string, $format="d-M-Y")
{
	if($string != '') 
	{
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $string, $datePart);
		return date ($format, mktime (0,0,0,$datePart[2], $datePart[3], $datePart[1]));
	}
}

/* vim: set expandtab: */

?>
