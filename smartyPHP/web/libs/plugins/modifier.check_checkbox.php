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
 * Name:     in_array<br>
 * Date:     Jan 08, 2004
 * Purpose:  Searches haystack for needle and returns TRUE if it is found in the array, FALSE otherwise
 * Input:<br>
 *         - needle = mixed needle
 *         - haystack = array haystack 
 *         - strict = strict check
 * Example:  {$needle|in_array:$haystack:$strict}
 * @version  1.0
 * @author	 Dinesh Sailor <dinesh@dotinfosys.com>
 * @param string
 * @return string
 */
function smarty_modifier_check_checkbox($vals, $string)
{
	$arr = explode(",",$string);
	if (in_array($vals, $arr)) 
	{
    	return "checked";
	}
}

?>