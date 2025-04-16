<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('registro', 'Registro::index');
$routes->get('quienesSomos', 'Home::quienesSomos');
