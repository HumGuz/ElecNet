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
//$route['default_controller'] = 'login';
$route['default_controller'] = 'sitio';
$route['404_override'] = 'not_found_404';
$route['translate_uri_dashes'] = FALSE;

//ver producto
$route['(:any)/(:num)'] = 'sitio/producto/$2';

//departamentos
$route['departamento/(:any)/(:num)'] = 'sitio/departamento/$2';
//departamentos con busqueda
$route['departamento/(:any)/(:num)/(:any)'] = 'sitio/departamento/$2/$3';
//paginacion de departamentos sin busqueda
$route['departamento/(:any)/(:num)/p/(:num)'] = 'sitio/departamento/$2/null/$3';
//paginacion de departamentos con busqueda
$route['departamento/(:any)/(:num)/(:any)/p/(:num)'] = 'sitio/departamento/$2/$3/$4';



//categoria
$route['categoria/(:any)/(:num)'] = 'sitio/categoria_grid/$2';
$route['categoria/lista/(:any)/(:num)'] = 'sitio/categoria_list/$2';

//categoria con busqueda
$route['categoria/(:any)/(:num)/(:any)'] = 'sitio/categoria/$2/$3';
//paginacion de categoria sin busqueda
$route['categoria/(:any)/(:num)/p/(:num)'] = 'sitio/categoria/$2/$3';
//paginacion de categoria con busqueda
$route['categoria/(:any)/(:num)/(:any)/p/(:num)'] = 'sitio/categoria/$2/$3/$4';


//subcategoria
$route['subcategoria/(:any)/(:num)'] = 'sitio/subcategoria/$2';
//subcategoria con busqueda
$route['subcategoria/(:any)/(:num)/(:any)'] = 'sitio/subcategoria/$2/$3';
//paginacion de subcategoria sin busqueda
$route['subcategoria/(:any)/(:num)/p/(:num)'] = 'sitio/subcategoria/$2/null/$3';
//paginacion de subcategoria con busqueda
$route['subcategoria/(:any)/(:num)/(:any)/p/(:num)'] = 'sitio/subcategoria/$2/$3/$4';


//busqueda
$route['busqueda/(:any)'] = 'sitio/busqueda/$1';
//paginacion de busqueda
$route['busqueda/(:any)/p/(:num)'] = 'sitio/busqueda/$1/$2';