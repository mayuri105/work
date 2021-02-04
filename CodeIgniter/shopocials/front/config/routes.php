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
$route['default_controller'] = 'home';
$route['about'] = 'page/about/';
$route['faq'] = 'page/faq/';
$route['how_it_works'] = 'page/how_it_works/';
$route['pricing'] = 'page/pricing/';
$route['contact'] = 'page/contact/';
$route['product'] = 'page/product/';
$route['product_detail'] = 'page/product_detail/';
$route['delivery_shipping_policy'] = 'page/delivery_shipping_policy/';
$route['cancellation'] = 'page/cancellation/';
$route['policy_for_buyer'] = 'page/policy_for_buyer/';
$route['refund_return_policy'] = 'page/refund_return_policy/';
$route['privacy_policy'] = 'page/privacy_policy/';
//$route['login'] = 'page/login/';
//$route['register'] = 'page/register/';//
$route['wishlist'] = 'page/wishlist/';
$route['seller_register'] = 'page/seller_register/';

