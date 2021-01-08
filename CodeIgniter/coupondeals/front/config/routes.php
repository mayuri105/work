<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();

$arr = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$alias = end($arr);
if ($alias) {

	

	$row3 = $db->get_where('tbl_product_deal', array('deal_slug'=> $alias))->row_array();  
	
	if($row3){
		$route[$alias] = 'home/show/'.$row3['deal_slug'];
	}    
	$row2 = $db->get_where('tbl_blogs', array('blog_slug'=> $alias))->row_array();  
	
	if($row2){
		$route[$alias] = 'blog/show/'.$row2['blog_slug'];
	}   
	$row1 = $db->get_where('tbl_blog_categories', array('blog_cat_slug'=> $alias))->row_array();  
	
	if($row1){
		$route[$alias] = 'blog/blogcat/'.$row1['blog_cat_slug'];
	}    
}

$route['default_controller'] = 'home';
$route['about'] = 'page/about';
$route['term-condition'] = 'page/termscondition';
$route['privacy'] = 'page/privacy';
$route['contact'] = 'page/contact';
$route['brands'] = 'page/brand';

$route['home/(:any)'] = 'home/index/$1';
//$route['blog/(:any)'] = 'blog/index/$1';
//$route['blog/(:any)'] = 'blog/blogcat/$1';
$route['addcomment'] = 'blog/add';
//$route['blogcat'] = 'blog/blogcat';

$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = true;


