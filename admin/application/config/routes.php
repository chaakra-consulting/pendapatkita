<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'admin';
$route['login'] = 'login';
$route['logout'] = 'admin/logout';
$route['surveyor'] = 'admin/surveyor';
$route['survey'] = 'admin/survey';
//$route['mc/(:any)'] = 'categories/main_category/$1';
$route['survey/(:any)'] = 'admin/survey/$1';
$route['survey/(:any)/(:any)'] = 'admin/survey/$1/$2';


$route['hasil/(:any)'] = 'admin/hasil/$1';

$route['hasilsurvey'] = 'admin/hasilsurvey';
$route['coba'] = 'admin/coba';
$route['hasilsurvey'] = 'admin/hasilsurvey';
$route['hasilsurvey/(:any)'] = 'admin/hasilsurvey/$1';
$route['hasilsurvey/(:any)/(:any)'] = 'admin/hasilsurvey/$1/$2';
$route['hasilsurvey/(:any)/(:any)/(:any)'] = 'admin/hasilsurvey/$1/$2/$3';

$route['koordinator'] = 'admin/koordinator';
$route['setting'] = 'admin/setting';
$route['404_override'] = 'admin/error';
$route['translate_uri_dashes'] = FALSE;
