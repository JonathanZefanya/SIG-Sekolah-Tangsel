<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('show/(:segment)', 'Home::show/$1');
$routes->get('rute/(:segment)', 'Home::rute/$1');

$routes->group('', ['filter' => 'loggedin'], function ($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login/process', 'Auth::verificationLogin');
});

$routes->group('', ['filter' => 'notloggedin'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');

    // Data Login
    $routes->get('user', 'UserLogin::index');
    $routes->get('user/create', 'UserLogin::create');
    $routes->post('user/save', 'UserLogin::save');
    $routes->get('user/edit/(:segment)', 'UserLogin::edit/$1');
    $routes->post('user/update/(:segment)', 'UserLogin::update/$1');
    $routes->get('user/delete/(:segment)', 'UserLogin::delete/$1');

    // Data Kecamatan
    $routes->get('kec', 'Kecamatan::index');
    $routes->get('kec/create', 'Kecamatan::create');
    $routes->post('kec/save', 'Kecamatan::save');
    $routes->get('kec/edit/(:segment)', 'Kecamatan::edit/$1');
    $routes->post('kec/update/(:segment)', 'Kecamatan::update/$1');
    $routes->get('kec/delete/(:segment)', 'Kecamatan::delete/$1');

    // Data Kelurahan
    $routes->get('kel', 'Kelurahan::index');
    $routes->get('kel/create', 'Kelurahan::create');
    $routes->post('kel/save', 'Kelurahan::save');
    $routes->get('kel/edit/(:segment)', 'Kelurahan::edit/$1');
    $routes->post('kel/update/(:segment)', 'Kelurahan::update/$1');
    $routes->get('kel/delete/(:segment)', 'Kelurahan::delete/$1');

    // Data Sekolah
    $routes->get('sekolah', 'Sekolah::index');
    $routes->get('sekolah/show/(:segment)', 'Sekolah::show/$1');
    $routes->get('sekolah/create', 'Sekolah::create');
    $routes->post('sekolah/save', 'Sekolah::save');
    $routes->get('sekolah/edit/(:segment)', 'Sekolah::edit/$1');
    $routes->post('sekolah/update/(:segment)', 'Sekolah::update/$1');
    $routes->get('sekolah/delete/(:segment)', 'Sekolah::delete/$1');

    // Get Data Kelurahan
    $routes->post('sekolah/getkelurahan', 'AddSekolah::getData');

    $routes->get('/logout', 'Auth::logout');
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
