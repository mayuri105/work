<?php
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");

$tpl->assign(array(	"T_Body"	=>	'index'. $config['tplEx'],
					"tot_Page"	=>	TotalPage(),
					"tot_Events"	=>	TotalEvents(),
					"tot_Blogs"	=>	TotalBlogs(),
					"tot_BlogComments"	=>	TotalBlogComments(),
					));

$tpl->display('default_layout'. $config['tplEx']);

?>