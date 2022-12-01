<?php

namespace Config;

use App\Controllers\Home;
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
// $routes->post('/home/simpan', Home::class);
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

$routes->group('login', function(RouteCollection $routes){
    $routes->get('lupa', 'PenggunaController::viewLupaPassword');
    $routes->get('/', 'PenggunaController::viewLogin');
    $routes->post('/', 'PenggunaController::login');
    $routes->delete('/', 'PenggunaController::logout');
    $routes->patch('/', 'PenggunaController::lupaPassword');
    
});
$routes->get('/logout', 'PenggunaController::logout');

$routes->group('pengguna', ['filter'=>'otentikasi'], function(RouteCollection $routes){
    $routes->get('/', 'PenggunaController::index');
    $routes->post('/', 'PenggunaController::store');
    $routes->patch('/', 'PenggunaController::update');
    $routes->delete('/', 'PenggunaController::delete');
    $routes->get('(:num)', 'PenggunaController::show/$1');
    $routes->get('all', 'PenggunaController::all');
});

$routes->group('metodebayar', function(RouteCollection $routes){
    $routes->get('/', 'MetodebayarController::index');
    $routes->post('/', 'MetodebayarController::store');
    $routes->patch('/', 'MetodebayarController::update');
    $routes->delete('/', 'MetodebayarController::delete');
    $routes->get('(:num)', 'MetodebayarController::show/$1');
    $routes->get('all', 'MetodebayarController::all');
});

$routes->group('tipetarif', function(RouteCollection $routes){
    $routes->get('/', 'TipetarifController::index');
    $routes->post('/', 'TipetarifController::store');
    $routes->patch('/', 'TipetarifController::update');
    $routes->delete('/', 'TipetarifController::delete');
    $routes->get('(:num)', 'TipetarifController::show/$1');
    $routes->get('all', 'TipetarifController::all');
});

$routes->group('kamartipe', function(RouteCollection $routes){
    $routes->get('/', 'KamartipeController::index');
    $routes->post('/', 'KamartipeController::store');
    $routes->patch('/', 'KamartipeController::update');
    $routes->delete('/', 'KamartipeController::delete');
    $routes->get('(:num)', 'KamartipeController::show/$1');
    $routes->get('all', 'KamartipeController::all');
});

$routes->group('kamartarif', function(RouteCollection $routes){
    $routes->get('/', 'KamartarifController::index');
    $routes->post('/', 'KamartarifController::store');
    $routes->patch('/', 'KamartarifController::update');
    $routes->delete('/', 'KamartarifController::delete');
    $routes->get('(:num)', 'KamartarifController::show/$1');
    $routes->get('all', 'KamartarifController::all');
});

$routes->group('kamarstatus', function(RouteCollection $routes){
    $routes->get('/', 'KamarstatusController::index');
    $routes->post('/', 'KamarstatusController::store');
    $routes->patch('/', 'KamarstatusController::update');
    $routes->delete('/', 'KamarstatusController::delete');
    $routes->get('(:num)', 'KamarstatusController::show/$1');
    $routes->get('all', 'KamarstatusController::all');
});

$routes->group('kamar', function(RouteCollection $routes){
    $routes->get('/', 'KamarController::index');
    $routes->post('/', 'KamarController::store');
    $routes->patch('/', 'KamarController::update');
    $routes->delete('/', 'KamarController::delete');
    $routes->get('(:num)', 'KamarController::show/$1');
    $routes->get('all', 'KamarController::all');
});

$routes->group('pemesananstatus', function(RouteCollection $routes){
    $routes->get('/', 'PemesananstatusController::index');
    $routes->post('/', 'PemesananstatusController::store');
    $routes->patch('/', 'PemesananstatusController::update');
    $routes->delete('/', 'PemesananstatusController::delete');
    $routes->get('(:num)', 'PemesananstatusController::show/$1');
    $routes->get('all', 'PemesananstatusController::all');
});

$routes->group('negara', function(RouteCollection $routes){
    $routes->get('/', 'NegaraController::index');
    $routes->post('/', 'NegaraController::store');
    $routes->patch('/', 'NegaraController::update');
    $routes->delete('/', 'NegaraController::delete');
    $routes->get('(:num)', 'NegaraController::show/$1');
    $routes->get('all', 'NegaraController::all');
});

$routes->group('tamu', function(RouteCollection $routes){
    $routes->get('/', 'TamuController::index');
    $routes->post('/', 'TamuController::store');
    $routes->patch('/', 'TamuController::update');
    $routes->delete('/', 'TamuController::delete');
    $routes->get('(:num)', 'TamuController::show/$1');
    $routes->get('all', 'TamuController::all');
});

$routes->group('pemesanan', function(RouteCollection $routes){
    $routes->get('/', 'PemesananController::index');
    $routes->post('/', 'PemesananController::store');
    $routes->patch('/', 'PemesananController::update');
    $routes->delete('/', 'PemesananController::delete');
    $routes->get('(:num)', 'PemesananController::show/$1');
    $routes->get('all', 'PemesananController::all');
});

$routes->group('kamardipesan', function(RouteCollection $routes){
    $routes->get('/', 'KamardipesanController::index');
    $routes->post('/', 'KamardipesanController::store');
    $routes->patch('/', 'KamardipesanController::update');
    $routes->delete('/', 'KamardipesanController::delete');
    $routes->get('(:num)', 'KamardipesanController::show/$1');
    $routes->get('all', 'KamardipesanController::all');
});

$routes->group('pembayaran', function(RouteCollection $routes){
    $routes->get('/', 'PembayaranController::index');
    $routes->post('/', 'PembayaranController::store');
    $routes->patch('/', 'PembayaranController::update');
    $routes->delete('/', 'PembayaranController::delete');
    $routes->get('(:num)', 'PembayaranController::show/$1');
    $routes->get('all', 'PembayaranController::all');
});







/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
