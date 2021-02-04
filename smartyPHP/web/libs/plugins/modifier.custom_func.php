<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty custom_func modifier plugin
 *
 * Type:     modifier<br>
 * Name:     custom_func<br>
 * Purpose:  format strings via sprintf
 * @link http://smarty.php.net/manual/en/language.modifier.string.format.php
 *          custom_func (Smarty online manual)
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_custom_func($string, $func)
{
    return $format($string);
}

/* vim: set expandtab: */

?>
