<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'panel';
$route['check_login'] = 'user';
// $route['complains'] = 'panel/complains';
// $route['complain'] = 'panel/complain';
// $route['complain/(.*)'] = 'panel/complain/$1';
// $route['shop/(.*)'] = 'front/product_detail';
// $route['order-sim/(.*)'] = 'front/order_sim/$1';


// $route['admin/'] = 'admin';
// $route['(.*)'] = 'front/product_detail';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
