<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Ruteo para las pages
$routes->get('/quienesSomos', 'Pages::quienesSomos');
$routes->get('/comercializacion', 'Pages::comercializacion');
$routes->get('/informacionContacto', 'Pages::informacionContacto');
$routes->get('/terminosYCondiciones', 'Pages::terminosYCondiciones');
$routes->get('/productos', 'Pages::productos');


// Rutas del Registro de Usuarios
$routes->get('/registro', 'UsuarioController::create');
$routes->post('/enviar-form', 'UsuarioController::formValidation');

// Rutas del login de Usuarios
$routes->get('/login', 'LoginController::create');
$routes->post('/enviar-login', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');

// Rutas de opciones de producto
$routes->get('/alta-producto', 'ProductoController::create_alta_producto');
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation');