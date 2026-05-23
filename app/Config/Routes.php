<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('make-hash', function () {
    echo password_hash('admin123', PASSWORD_DEFAULT);
});

$routes->get('/', 'Auth::login', ['filter' => 'guest']);

$routes->get('auth/login', 'Auth::login', ['filter' => 'guest']);
$routes->post('auth/authenticate', 'Auth::authenticate');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('/users/admin_management', 'Users::admin_management', ['filter' => 'superadmin']);
$routes->post('/users/add_admin', 'Users::add_admin', ['filter' => 'superadmin']);
$routes->post('/users/delete_admin/(:num)', 'Users::delete_admin/$1', ['filter' => 'superadmin']);

$routes->get('/users/dashboard', 'Users::dashboard', ['filter' => 'adminonly']);
$routes->get('/users/product', 'Users::product', ['filter' => 'adminonly']);
$routes->get('/users/create', 'Users::create', ['filter' => 'adminonly']);
$routes->post('/users/store', 'Users::store', ['filter' => 'adminonly']);
$routes->get('/users/edit/(:num)', 'Users::edit/$1', ['filter' => 'adminonly']);
$routes->post('/users/update/(:num)', 'Users::update/$1', ['filter' => 'adminonly']);
$routes->get('/users/delete/(:num)', 'Users::delete/$1', ['filter' => 'adminonly']);

$routes->get('/users/globe_sim', 'Users::globe_sim', ['filter' => 'adminonly']);
$routes->get('/users/smart_sim', 'Users::smart_sim', ['filter' => 'adminonly']);
$routes->post('/users/add_globe', 'Users::add_globe', ['filter' => 'adminonly']);
$routes->post('/users/add_smart', 'Users::add_smart', ['filter' => 'adminonly']);

$routes->get('/users/edit_sim/(:num)', 'Users::edit_sim/$1', ['filter' => 'adminonly']);
$routes->post('/users/update_sim/(:num)', 'Users::update_sim/$1', ['filter' => 'adminonly']);
$routes->post('/users/deleteSelected', 'Users::deleteSelected', ['filter' => 'adminonly']);

$routes->get('/users/gateway_visual', 'Users::gateway_visual', ['filter' => 'adminonly']);
$routes->get('/users/export', 'Users::export', ['filter' => 'adminonly']);
$routes->post('/users/upload-excel', 'Users::uploadExcel', ['filter' => 'adminonly']);
$routes->get('/users/inactive-list', 'Users::inactiveList', ['filter' => 'adminonly']);









