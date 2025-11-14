<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 
$route['api/users']['GET'] = 'FAS/UserController/index';
$route['api/users']['POST'] = 'FAS/UserController/create';
$route['api/users/(:num)']['PUT'] = 'FAS/UserController/update/$1';
$route['api/users/(:num)']['Delete'] = 'FAS/UserController/delete/$1';
$route['api/profile/(:num)']['POST'] = 'API/Upload/profile/$1';


$route['api/upload']['POST'] = 'API/Upload/image';

//AdminDash
// ✅ UI Routes
$route['admin/dashboard'] = 'adminDash/AdminController/index';
$route['admin/users'] = 'adminDash/AdminController/users';
$route['admin/login'] = 'adminDash/AdminController/login';
$route['admin/logout'] = 'adminDash/AdminController/logout';
$route['admin/register'] = 'adminDash/AdminController/register';


// ✅ API Routes
$route['api/admin']['GET'] = 'adminApi/AdminApi/index';
$route['api/admin/(:num)']['GET'] = 'adminApi/AdminApi/index/$1';
$route['api/admin']['POST'] = 'adminApi/AdminApi/create';
$route['api/admin/(:num)']['PUT'] = 'adminApi/AdminApi/update/$1';
$route['api/admin/(:num)']['DELETE'] = 'adminApi/AdminApi/delete/$1';
$route['api/login']['POST'] = 'adminApi/AdminApi/login';


$route['about'] = 'pages/about';
$route['contact'] = 'pages/contact';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
