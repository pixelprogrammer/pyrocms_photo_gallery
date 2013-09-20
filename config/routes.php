<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$route = array();
// public
$route['photo_gallery'] = 'gallery';
$route['photo_gallery/index'] = 'gallery';

// admin
$route['admin/photo_gallery/add_image/(:any)'] = 'add_image/$1';
// $route['blog/admin/categories(/:any)?'] = 'admin_categories$1';
// $route['blog/admin/fields(/:any)?']      = 'admin_fields$1';