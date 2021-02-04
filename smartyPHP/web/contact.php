<?php
define('IN_SITE', 	true);
include_once("includes/common.php"); 
include_once($physical_path['DB_Access']. 'Contact.php');
 
$contact	= new Contact();

$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll'); 
 

if($_POST['submit'] == 'Submit')
{
	$key=substr($_SESSION['key'],0,5);
	$number = $_POST['captcha'];
	if($number==$key)
	{
		$contact->InsertContact($_POST);
		//////////////  Mail Send //////////
		global $mail;
		$mail = '';
		$mail = new htmlMimeMail();
		$mail->setFrom($_POST['email']);
		
		$subject ='Contact from website';
		$mail->setSubject($subject);
		$tpl2 = new Smarty;
		$tpl2->template_dir = $physical_path['EmailTemplate'];
		$tpl2->compile_dir 	= $physical_path['Site_Root']. 'templates_c/';
		$tpl2->debugging 	= DEBUG;
		$tpl2->assign('name',stripslashes($_POST['name']));
		$tpl2->assign('phone_number',stripslashes($_POST['phone_number']));
		$tpl2->assign('company',stripslashes($_POST['company']));
		$tpl2->assign('email',$_POST['email']);
		$tpl2->assign('comments',stripslashes($_POST['comments']));
		
		$content = $tpl2->fetch('contact_us'. $config['tplEx']);
		/*print_r ($content);die;*/
		$mail->setHtml($content);
		
		$result = $mail->send(array($config[WC_CONTACT_US]));
	
		header('Location:contact.html?flag=true');
	}
	else
	{
		$errorMsg = '<b style="color:red;font-size:16px;">Entered Captcha Code is Wrong.</b>';
	}
}

if($_GET['flag']==true)
	$succmessage = '<b style="color:green;font-size:16px;">Thank you for your enquiry. We will be in touch very soon.</b>';
	
$tpl->assign(array("T_Body"			=>	'contact'. $config['tplEx'],
					"JavaScript"		=>  array("contact.js"),
					"selected"      => $filename['url'], 
					"Site_Title"		=>	($config[WC_SITE_TITLE]),
					"Meta_Keyword"		=>	($config[WC_SITE_KEYWORD]),
					"Meta_Description"	=>	($config[site_description]), 
					"succmessage"	=>	$succmessage,
					"errorMsg"		=>	$errorMsg,
					
			));

$tpl->display('default_layout'. $config['tplEx']);
?>
