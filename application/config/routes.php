<?php
defined('BASEPATH') or exit('No direct script access allowed');


// $route['view']                          = 'frontpage/view';
$route['login'] = 'authentication/login';
$route['signup'] = 'authentication/register';
$route['signup/(:any)/(:any)'] = 'authentication/register/$1/$2';
$route['logout'] = 'authentication/logout';

$route['download-pdf/(:any)'] = 'dashboard/downloadsertif/$1';

$route['dashboard'] = 'dashboard/view_page/dashboard';       // default member dashboard
$route['dashboard/(:any)'] = 'dashboard/view_page/$1';       // halaman dinamis member

// ROUTE STAFF
$route['staff'] = 'staff/index';           // default ke dashboard staff
$route['staff/(:any)'] = 'staff/index/$1'; // semua halaman staff
$route['staff/edit-lowongan/(:any)'] = 'staff/editindexxx/$1';


// ROUTE ADMIN
$route['admin'] = 'administrator/index';
$route['admin/(:any)'] = 'administrator/index/$1';
$route['admin/edit-testimoni/(:any)'] = 'administrator/editindex/$1';
$route['admin/edit-blog/(:any)'] = 'administrator/editindexx/$1';

$route['blog'] = 'frontpage/blog';
$route['blog-detail/(:any)'] = 'frontpage/blog_detail/$1';
$route['karir'] = 'frontpage/karir';
$route['detail-lowongan/(:any)'] = 'frontpage/detail_lowongan/$1';


$route['(:any)'] = 'frontpage/index/$1';

$route['default_controller'] = 'frontpage/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['member/update_profile'] = 'postdata/member_post/member/update_profile';
