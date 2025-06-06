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
$routes->get('/registro', 'UsuarioController::index_registrar');
$routes->post('/enviar-form', 'UsuarioController::formValidation');

// Rutas del login de Usuarios
$routes->get('/login', 'LoginController::create');
$routes->post('/enviar-login', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');

// Rutas para el crud del usuario
$routes->get('/crud-usuarios', 'UsuarioController::index');
$routes->post('/crud-usuarios', 'UsuarioController::index');

// Rutas para la configuracion del perfil del usuario
$routes->get('/perfil', 'UsuarioController::index_perfil');
$routes->post('/guardarCambios', 'UsuarioController::guardarCambios');

// Rutas para el crud de productos
$routes->get('/crud-productos', 'ProductoController::index');
$routes->post('/crud-productos', 'ProductoController::index');

// Rutas para el alta de producto
$routes->get('/alta-producto', 'ProductoController::create_alta_producto');
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation');
$routes->get('/delete-producto/(:num)', 'ProductoController::delete_producto/$1');
$routes->get('/activar-producto/(:num)', 'ProductoController::activar_producto/$1');
$routes->get('/editar-producto/(:num)', 'ProductoController::editar_producto/$1');
$routes->post('/modificar-producto/(:num)', 'ProductoController::modificar_producto/$1');
$routes->get('/ver-eliminados', 'ProductoController::eliminados');