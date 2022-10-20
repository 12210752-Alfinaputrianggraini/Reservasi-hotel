<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('kamartarif', function(RouteCollection $routes){
   $routes->get('/', 'Kamartarifcontroller::index');
   $routes->post('/', 'Kamartarifcontroller::store');
   $routes->patch('/', 'Kamartarifcontroller::update');
   $routes->delete('/', 'Kamartarifcontroller::delete');
   $routes->get('(:num)', 'Kamartarifcontroller::show/$1');
   $routes->get('all', 'Kamartarifcontroller::all');
});

$routes->group('kamarstatus', function(RouteCollection $routes){
    $routes->get('/', 'Kamarstatuscontroller::index');
    $routes->post('/', 'Kamarstatuscontroller::store');
    $routes->patch('/', 'Kamarstatuscontroller::update');
    $routes->delete('/', 'Kamarstatuscontroller::delete');
    $routes->get('(:num)', 'Kamarstatuscontroller::show/$1');
    $routes->get('all', 'Kamarstatuscontroller::all');
 });

 $routes->group('kamar', function(RouteCollection $routes){
    $routes->get('/', 'kamarcontroller::index');
    $routes->post('/', 'kamarcontroller::store');
    $routes->patch('/', 'kamarcontroller::update');
    $routes->delete('/', 'kamarstatuscontroller::delete');
    $routes->get('(:num)', 'kamarstatuscontroller::show/$1');
    $routes->get('all', 'kamarstatuscontroller::all');
 });

 $routes->group('pemesananstatus', function(RouteCollection $routes){
    $routes->get('/', 'pemesananstatuscontroller::index');
    $routes->post('/', 'pemesananstatuscontroller::store');
    $routes->patch('/', 'pemesananstatuscontroller::update');
    $routes->delete('/', 'pemesananstatuscontroller::delete');
    $routes->get('(:num)', 'pemesananstatuscontroller::show/$1');
    $routes->get('all', 'pemesananstatuscontroller::all');
 });
 
