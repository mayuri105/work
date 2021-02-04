<?php
define('IN_SITE', 	true);
include_once("includes/common.php");
include_once($physical_path['DB_Access']. 'Blog.php'); 
$blog = new Blog(); 
 
$blog->BlogPost($_GET['year'],$_GET['month']);

$Loop_Blog = $db->num_rows();
$i = 0;
while($db->next_record())
{
	$title[$i]			=	stripslashes($db->f('title'));
	$short_desc[$i]		=	stripslashes($db->f('short_desc'));
	$html_link[$i]		=	stripslashes($db->f('html_link'));
	$post_date[$i]		=	stripslashes($db->f('post_date'));
	$comment_count[$i]  =   $blog->CountComments($db->f('post_id'));
	$i++;
}
 
	$tpl->assign(array("T_Body"			=>	'index'. $config['tplEx'],
						//"JavaScript"	=>  array("newsletter_signup.js"),
						"isIndex"		=> 	1,
						"selected"      => $filename['url'], 
						//"blogList"		=>	$blog->BlogPost($_GET['year'],$_GET['month']),
						"blogYear"		=>	$blog->blog_archive("YEAR"),
						"blogMonth"		=>	$blog->blog_archive("YEAR,MONTH"), 
						"Site_Title"		=>	($rec->meta_title!=''?$rec->meta_title:$config[WC_SITE_TITLE]),
						"Meta_Keyword"		=>	($rec->meta_keyword!=''?$rec->meta_keyword:$config[WC_SITE_KEYWORD]),
						"Meta_Description"	=>	($rec->meta_description!=''?$rec->meta_description:$config[site_description]),	
						"Loop_Blog"			=>	$i,
						"title"				=>	$title,	
						"short_desc"		=>	$short_desc,	
						"html_link"			=>	$html_link,	
						"post_date"			=>	$post_date,					
						"comment_count"			=>	$comment_count,					
						));
	//$objSmarty->assign("common", "blog"); 
$tpl->display('default_layout'. $config['tplEx']);
?>
