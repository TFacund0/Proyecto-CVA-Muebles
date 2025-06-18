<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// -------------------- RUTAS SIN FILTRO DE AUTENTICACIÓN --------------------

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

// Ruta para el formulario de consulta
$routes->post('/enviar-consulta', 'ConsultaController::cargarConsulta');

// -------------------- RUTAS CON FILTRO DE AUTENTICACIÓN --------------------

// Rutas para las ventas
$routes->get('/ventas-list', 'VentasController::index_ventas', ['filter' => 'auth']);

// Rutas para el crud del usuario
$routes->get('/crud-usuarios', 'UsuarioController::index', ['filter' => 'auth']);
$routes->post('/crud-usuarios', 'UsuarioController::index', ['filter' => 'auth']);

// Rutas para la configuracion del perfil del usuario
$routes->get('/perfil', 'UsuarioController::index_perfil', ['filter' => 'auth']);
$routes->post('/guardarCambios', 'UsuarioController::guardarCambios', ['filter' => 'auth']);

// Rutas para el crud de productos
$routes->get('/crud-productos', 'ProductoController::index', ['filter' => 'auth']);
$routes->post('/crud-productos', 'ProductoController::index', ['filter' => 'auth']);
$routes->get('/ver-eliminados', 'ProductoController::eliminados', ['filter' => 'auth']);

// Rutas para el alta de producto
$routes->get('/alta-producto', 'ProductoController::create_alta_producto', ['filter' => 'auth']);
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation', ['filter' => 'auth']);

// Rutas para eliminar el producto
$routes->get('/delete-producto/(:num)', 'ProductoController::delete_producto/$1', ['filter' => 'auth']);
$routes->get('/activar-producto/(:num)', 'ProductoController::activar_producto/$1', ['filter' => 'auth']);

// Rutas para editar el producto
$routes->get('/editar-producto/(:num)', 'ProductoController::index_editar_producto/$1', ['filter' => 'auth']);
$routes->post('modificar-producto/(:num)', 'ProductoController::modificar_producto/$1', ['filter' => 'auth']);

//muestra todos los productos del catalogo
$routes->get('/todos_p','carrito_controller::catalogo', ['filter' => 'auth']);

//carga la vista carrito_parte_view
$routes->get('/muestro','carrito_controller::muestra', ['filter' => 'auth']);

//actualiza los datos del carrito
$routes->get('/carrito_actualiza','carrito_controller::actualiza_carrito', ['filter' => 'auth']);

//agregar los items seleccionados
$routes->post('/carrito/add','carrito_controller::add', ['filter' => 'auth']);

//elimina un item del carrito
$routes->get('/carrito_elimina/(:any)','carrito_controller::remove/$1', ['filter' => 'auth']);

//eliminar todo el carrito
$routes->get('/borrar','carrito_controller::borrar_carrito', ['filter' => 'auth']);

//Registrar la venta en las tablas
$routes->get('/carrito_comprar','VentasController::registrar_venta', ['filter' => 'auth']);

//botones de sumar y restar en la vista del carrito
$routes->get('carrito_suma/(:any)', 'carrito_controller::suma/$1', ['filter' => 'auth']);
$routes->get('carrito_resta/(:any)', 'carrito_controller::resta/$1', ['filter' => 'auth']);

// Rutas para el detalle de ventas
$routes->get('/ventas_detalle', 'VentasController::index_ventas', ['filter' => 'auth']);
$routes->get('/factura/(:num)', 'VentasController::ver_factura/$1', ['filter' => 'auth']);

// Rutas para el crud de consultas
$routes->get('/lista-consultas', 'ConsultaController::index', ['filter' => 'auth']);
$routes->get('/consultas', 'ConsultaController::listarConsultas', ['filter' => 'auth']);
$routes->post('/consultas/eliminar/(:num)', 'ConsultaController::eliminarConsulta/$1', ['filter' => 'auth']);
