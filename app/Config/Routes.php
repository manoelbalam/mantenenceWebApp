<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->match(['get', 'post'], '/auth/login', 'Auth::login');
$routes->match(['get', 'post'], '/auth/register', 'Auth::register');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/', 'Home::index');

// $routes->match(['get', 'post', 'put'], 'maintenance', 'Maintenance::maintenance');
$routes->get('maintenance', 'Maintenance::index');
$routes->get('maintenance/maintenance_all', 'Maintenance::maintenance_all');
$routes->post('maintenance/maintenance_add', 'Maintenance::maintenance_add');
$routes->post('maintenance/maintenance_update', 'Maintenance::maintenance_update');
$routes->post('maintenance/maintenance_delete/(:num)', 'Maintenance::maintenance_delete/$1');
$routes->get('maintenance/getmaintenance/(:num)', 'Maintenance::getmaintenance/$1');

$routes->get('user/user_all', 'User::user_all');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}