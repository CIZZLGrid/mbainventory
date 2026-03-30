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









