<?php
function smarty_function_html_richtext($params, &$smarty)
{
	extract($params);
	
	// include the control file
	include EDITOR_ROOT.'spaw_control.class.php';
	
	$sw = new SPAW_Wysiwyg(
						   $RichTextName /*name*/,
						   stripslashes($RichTextValue) /*value*/,
						   'en' /*language*/,
						   $toolbar /*toolbar mode*/,
						   'default' /*theme*/,
						   $width /*width*/,
						   $height.'px' /*height*/
						   );
	$sw->show();
}

?>
