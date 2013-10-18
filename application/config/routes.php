<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

$route['(home|about|faq|contacto|construction|test)'] = 'site/$1'; 

$route['message/(:any)'] = "members/message/$1";
$route['search(:any)'] = "search/index/$1";
$route['search'] = "search/index";

$route['noticias'] = "noticias";
$route['noticias/(:num)'] = "noticias/index/$1";
$route['noticias/(:any)'] = "noticias/tag/$1";
$route['noticias/(:any)/(:any)'] = "noticias/tag/$1/$2";
$route['(:num)/(:num)/(:num)/(:any)'] = "noticias/single/$4";

$route['gallery/(:num)'] = "galeria/index/$1";
$route['gallery/(:num)/(:num)'] = "galeria/single/$1";

$route['members'] = "members";
$route['members/(:any)'] = "members/$1";

$route['admin/list/(:any)'] = "admin/$1";
$route['admin/list/(:any)/(:num)'] = "admin/$1/$2";

$route['admin/edit/(:any)/(:any)/(:num)'] = "admin/edit_$1/$2/$3";
$route['admin/edit/(:any)/(:any)'] = "admin/edit_$1/$2";

$route['admin/new/(:any)'] = "admin/new_$1";

$route['admin/activate/(:any)/(:any)'] = "admin/activate_$1/$2";
$route['admin/deactivate/(:any)/(:any)'] = "admin/deactivate_$1/$2";
$route['admin/delete/(:any)/(:any)'] = "admin/delete_$1/$2";

$route['admin/(:any)/(:any)'] = "admin/$1/$2";
$route['admin/(:any)'] = "admin/$1";
$route['admin'] = "admin";

$route['(:any)'] = "section/index/$1";
$route['(:any)/(:any)'] = "section/index/$1/$2";




/* End of file routes.php */
/* Location: ./application/config/routes.php */