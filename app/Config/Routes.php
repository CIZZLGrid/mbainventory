<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/users/product', 'Users::product');

$routes->get('/users/create', 'Users::create');

$routes->post('/users/store', 'Users::store');

$routes->get('/users/edit/(:num)', 'Users::edit/$1');

$routes->post('/users/update/(:num)', 'Users::update/$1');

$routes->get('/users/delete/(:num)', 'Users::delete/$1');

$routes->get('/users/globe_sim', 'Users::globe_sim');

$routes->get('/users/smart_sim', 'Users::smart_sim');

$routes->post('/users/add_globe', 'Users::add_globe');

$routes->post('/users/add_smart', 'Users::add_smart');

$routes->get('/users/edit_sim/(:num)', 'Users::edit_sim/$1');

$routes->post('users/update_sim/(:num)', 'Users::update_sim/$1');

$routes->get('users/login', 'Users::login');




