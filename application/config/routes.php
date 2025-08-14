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
|	https://codeigniter.com/userguide3/general/routing.html
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


$route['admin'] = 'admin/login';
// $route['dashboard_admin'] = 'admin/dashboard';


// admin routes
$route['category'] = 'admin/category';
$route['add_category'] = 'admin/category/add_category';
$route['sub_category'] = 'admin/category/sub_category';
$route['add_sub_category'] = 'admin/category/add_sub_category';
$route['edit/(:num)'] = 'admin/category/edit/$1';
$route['edit_main/(:num)'] = 'admin/category/edit_main/$1';
$route['slider'] = 'admin/category/slider';
$route['add_slider'] = 'admin/category/add_slider';
$route['city'] = 'admin/category/city';
$route['add_city'] = 'admin/category/add_city';
$route['edit_city/(:num)'] = 'admin/category/edit_city/$1';
$route['partner'] = 'admin/partner';
$route['loginAsPartner/(:num)'] = 'admin/partner/loginAsPartner/$1';
$route['customers'] = 'admin/customers';




//provider route
$route['wallet'] = 'provider/wallet';
$route['scheduled'] = 'provider/wallet/scheduled';
$route['provider'] = 'provider/login';
$route['provider/sing_up'] = 'provider/login/sing_up';
$route['send_register_otp'] = 'provider/login/send_register_otp';
$route['service'] = 'provider/service';
$route['add_service'] = 'provider/service/add_service';
$route['edit_service/(:num)'] = 'provider/service/edit_service/$1';
$route['provider/logout'] = 'provider/login/logout';


// User Route
$route['providers'] = 'profile';
$route['provider_details/(:num)'] = 'profile/provider_details/$1';
$route['services'] = 'services';
$route['login'] = 'login';
$route['logout'] = 'login/logout';
$route['customer'] = 'provider/customers';
$route['booking'] = 'provider/customers/booking';



$route['sign_in'] = 'login/sign_in';
$route['cart'] = 'cart';
$route['profile'] = 'profile/profile';
$route['contact'] = 'home/contact';

































$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
