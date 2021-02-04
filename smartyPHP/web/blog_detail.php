<?php
define('IN_SITE', 	true);
include_once("includes/common.php");
include_once($physical_path['DB_Access']. 'Blog.php');
$blog = new Blog();
$rsBlog = $blog->getBlogByLink(isset($_GET['blog_link']) ? $_GET['blog_link'] : (isset($_POST['blog_link']) ? $blog_link['pid'] : 1));

if($_POST['Action'] == 'Comment' && $_POST['submit'] == 'Submit')
{
	$key=substr($_SESSION['key'],0,5);
	$number = $_POST['captcha'];
	if($number==$key)
	{
		$res = $blog->Insert_Comment($_POST);
		if($res == 1)
		{
			$blogDetail = $blog->getBlog($_POST['post_id']);
			
			global $mail;
			$mail = '';
			$mail = new htmlMimeMail();
			$mail->setFrom($_POST['comment_email']);
			$mail->setSubject('Comment Posted on Site');
			
			$tpl2 = new Smarty;
			$tpl2->template_dir = $physical_path['EmailTemplate'];
			$tpl2->compile_dir 	= $physical_path['Site_Root']. 'templates_c/';
			$tpl2->debugging 	= DEBUG;
			$tpl2->assign('blog_title',stripslashes($blogDetail->title));
			$tpl2->assign('comment_by',$_POST['comment_by']);
			$tpl2->assign('email',$_POST['comment_email']);
			$tpl2->assign('comment',$_POST['comment']);
			$tpl2->assign('comment_date',date('Y-m-d'));
			
			$content = $tpl2->fetch('blog_post'. $config['tplEx']);
			//echo $content ;die;
			$mail->setHtml($content);
//			$result = $mail->send(array($config[WC_BLOG]));
		
			$success ='true';
		}
		else
		{
			$error ='true';
		}
	}
	else
	{
		$message = '<b style="color:red;font-size:16px;">Invalid captcha entered.</b>';
		
	}
}

if($error != '')
{
	$comment_error = '<b style="color:red;font-size:16px;">You can not post comment!</b>';
}
else if($success != '')
{
	$comment_posted = '<b style="color:green;font-size:16px;">Thank you for submitting your comment. Your comment is now under review.</b>';
}


if($_GET['blog_link']!='')
{
	# check wheather this category exist or not
	$link_valid	=	IsLinkValid(BLOG_POST,"html_link",$_GET['blog_link'],1);
	
	if($link_valid == 0)
	{
		$tpl->assign(array( "T_Body"		=>	'link_not_available'. $config['tplEx'],
							"page_title"	=>	'Page Not Found' ,
						  ));
	}
	else
	{
		$blogDetail = $blog->getBlogByLink($_GET['blog_link']); 
		$comment_count = $blog->getCommentsCount($blogDetail->post_id);
		
		$blogContent	=	stripslashes($blogDetail->content);  
		
	$tpl->assign(array(	"T_Body"		=>	'blog_detail'. $config['tplEx'],
						"JavaScript"	=>  array("blog_detail.js"),
						"selected"      => $filename['url'], 
						"post_id"		=>	$rsBlog->post_id,
						"post_date"		=>	$rsBlog->post_date,
						"cat_id"		=>	$rsBlog->cat_id,
						"image"			=>	$rsBlog->blog_img,
						"title"	=>	stripslashes($rsBlog->title),
						"content"		=>	stripslashes($rsBlog->content),
						"Site_Title"		=>	($rsBlog->meta_title!=''?$rsBlog->meta_title:$config[WC_SITE_TITLE]),
						"Meta_Keyword"		=>	($rsBlog->meta_keyword!=''?$rsBlog->meta_keyword:$config[WC_SITE_KEYWORD]),
						"Meta_Description"	=>	($rsBlog->meta_description!=''?$rsBlog->meta_description:$config[site_description]), 
						"img_path"		=>	$virtual_path['Blog'],
							"comment_count" =>  $comment_count, 
							"comment_posted" => $comment_posted,
							"comment_error" => $comment_error,
							"comment_list"	=>	$blog->List_Comments_On_Post($rsBlog->post_id), 
							"blog_page"		=>	1,
							"message"		=>	$message,					
				));		
	}				
}
			
$tpl->display('default_layout'. $config['tplEx']);
?>
