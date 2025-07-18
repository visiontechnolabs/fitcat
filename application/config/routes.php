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
$route['provider'] = 'login';
$route['admin'] = 'admin/login';
$route['dashboard_admin'] = 'admin/dashboard';

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















$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
