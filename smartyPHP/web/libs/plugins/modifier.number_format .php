<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_number_format($number, $decimals='', $dec_point='', $thousands_sep='')
{
	return number_format($number, $decimals, $dec_point, $thousands_sep);
}

/* vim: set expandtab: */

?>
