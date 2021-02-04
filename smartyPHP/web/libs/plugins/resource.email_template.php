<?php
/*
 * Smarty plugin
 * ------------------------------------------------------------- 
 * File:     resource.db.php
 * Type:     resource
 * Name:     db
 * Purpose:  Fetches templates from a database
 * -------------------------------------------------------------
 */
function smarty_resource_email_template_source($email_id, &$email_source, &$smarty)
{
	global $db;
	
    // do database call here to fetch your template,
    // populating $tpl_source
	$sql = " SELECT email_content FROM email_template "
		 . " WHERE email_id =  '". $email_id ."'";
			
	$db->query($sql);
	$db->next_record();

    if ($db->num_rows()) {
        $email_source = $db->f('email_content');
        return true;
    } else {
        return false;
    }
}

function smarty_resource_email_template_timestamp($email_id, &$email_timestamp, &$smarty)
{
	global $db;
	
    // do database call here to fetch your template,
    // populating $tpl_source
	$sql = " SELECT email_timestamp FROM email_template "
		 . " WHERE email_id =  '". $email_id ."'";
		
	$db->query($sql);
	$db->next_record();

    if ($db->num_rows()) {
        $email_timestamp = $db->f('email_timestamp');
        return true;
    } else {
        return false;
    }
}

function smarty_resource_email_template_secure($tpl_name, &$smarty)
{
    // assume all templates are secure
    return true;
}

function smarty_resource_email_template_trusted($tpl_name, &$smarty)
{
    // not used for templates
}
?>
