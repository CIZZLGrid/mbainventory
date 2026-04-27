<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/users/product', 'Users::product', ['filter' => 'authfilter']);

$routes->get('/users/create', 'Users::create', ['filter' => 'authfilter']);

$routes->post('/users/store', 'Users::store', ['filter' => 'authfilter']);

$routes->get('/users/edit/(:num)', 'Users::edit/$1', ['filter' => 'authfilter']);

$routes->post('/users/update/(:num)', 'Users::update/$1', ['filter' => 'authfilter']);

$routes->get('/users/delete/(:num)', 'Users::delete/$1', ['filter' => 'authfilter']);

$routes->get('/users/globe_sim', 'Users::globe_sim', ['filter' => 'authfilter']);

$routes->get('/users/smart_sim', 'Users::smart_sim', ['filter' => 'authfilter']);

$routes->post('/users/add_globe', 'Users::add_globe', ['filter' => 'authfilter']);

$routes->post('/users/add_smart', 'Users::add_smart', ['filter' => 'authfilter']);

$routes->get('/users/edit_sim/(:num)', 'Users::edit_sim/$1', ['filter' => 'authfilter']);

$routes->post('users/update_sim/(:num)', 'Users::update_sim/$1', ['filter' => 'authfilter']);

$routes->get('/users/gateway_visual', 'Users::gateway_visual', ['filter' => 'authfilter']);


$routes->get('auth/login', 'Auth::login', ['filter' => 'guest']);

$routes->post('auth/authenticate', 'Auth::authenticate');

$routes->get('auth/logout', 'Auth::logout');

$routes->get('/users/export', 'Users::export', ['filter' => 'authfilter']);







