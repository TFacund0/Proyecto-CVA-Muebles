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

// Rutas para las ventas
$routes->get('/ventas-list', 'VentasController::index_ventas');

// Rutas para el crud del usuario
$routes->get('/crud-usuarios', 'UsuarioController::index');
$routes->post('/crud-usuarios', 'UsuarioController::index');

// Rutas para la configuracion del perfil del usuario
$routes->get('/perfil', 'UsuarioController::index_perfil');
$routes->post('/guardarCambios', 'UsuarioController::guardarCambios');

// Rutas para el crud de productos
$routes->get('/crud-productos', 'ProductoController::index');
$routes->post('/crud-productos', 'ProductoController::index');
$routes->get('/ver-eliminados', 'ProductoController::eliminados');

// Rutas para el alta de producto
$routes->get('/alta-producto', 'ProductoController::create_alta_producto');
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation');

// Rutas para eliminar el producto
$routes->get('/delete-producto/(:num)', 'ProductoController::delete_producto/$1');
$routes->get('/activar-producto/(:num)', 'ProductoController::activar_producto/$1');

// Rutas para editar el producto
$routes->get('/editar-producto/(:num)', 'ProductoController::index_editar_producto/$1');
$routes->post('modificar-producto/(:num)', 'ProductoController::modificar_producto/$1');

//muestra todos los productos del catalogo
$routes->get('/todos_p','carrito_controller::catalogo');

//carga la vista carrito_parte_view
$routes->get('/muestro','carrito_controller::muestra');

//actualiza los datos del carrito
$routes->get('/carrito_actualiza','carrito_controller::actualiza_carrito');

//agregar los items seleccionados
$routes->post('/carrito/add','carrito_controller::add');

//elimina un item del carrito
$routes->get('/carrito_elimina/(:any)','carrito_controller::remove/$1');

//eliminar todo el carrito
$routes->get('/borrar','carrito_controller::borrar_carrito');

//Registrar la venta en las tablas
$routes->get('/carrito-comprar','Ventascontroller::registrar_venta');

//botones de sumar y restar en la vista del carrito
$routes->get('carrito_suma/(:any)', 'carrito_controller::suma/$1');
$routes->get('carrito_resta/(:any)', 'carrito_controller::resta/$1');
