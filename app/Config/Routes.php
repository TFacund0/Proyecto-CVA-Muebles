<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// -------------------- RUTA PRINCIPAL --------------------
$routes->get('/', 'Home::index');


// ====================================================================
//                      RUTAS SIN FILTRO DE AUTENTICACIÓN
// ====================================================================

// -------------------- Páginas informativas --------------------
$routes->get('/quienesSomos', 'Pages::quienesSomos');
$routes->get('/comercializacion', 'Pages::comercializacion');
$routes->get('/informacionContacto', 'Pages::informacionContacto');
$routes->get('/terminosYCondiciones', 'Pages::terminosYCondiciones');
$routes->get('/productos', 'Pages::productos');

// -------------------- Registro de usuarios --------------------
$routes->get('/registro', 'UsuarioController::index_registrar');
$routes->post('/enviar-form', 'UsuarioController::formValidation');

// -------------------- Login de usuarios --------------------
$routes->get('/login', 'LoginController::create');
$routes->post('/enviar-login', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');

// -------------------- Consultas públicas --------------------
$routes->post('/enviar-consulta', 'ConsultaController::cargarConsulta');


// ====================================================================
//                      RUTAS CON FILTRO DE AUTENTICACIÓN
// ====================================================================


// -------------------- Gestión de Ventas --------------------
$routes->get('/ventas-list', 'VentasController::index_ventas', ['filter' => 'auth']);
$routes->get('/ventas_detalle', 'VentasController::index_ventas', ['filter' => 'auth']);
$routes->get('/factura/(:num)', 'VentasController::ver_factura/$1', ['filter' => 'auth']);
$routes->get('/carrito_comprar', 'VentasController::registrar_venta', ['filter' => 'auth']);


// -------------------- Gestión de Usuarios --------------------
$routes->get('/crud-usuarios', 'UsuarioController::index', ['filter' => 'auth']);
$routes->post('/crud-usuarios', 'UsuarioController::index', ['filter' => 'auth']);

// -------------------- Perfil de Usuario --------------------
$routes->get('/perfil', 'UsuarioController::index_perfil', ['filter' => 'auth']);
$routes->post('/guardarCambios', 'UsuarioController::guardarCambios', ['filter' => 'auth']);


// -------------------- Gestión de Productos --------------------
$routes->get('/crud-productos', 'ProductoController::index', ['filter' => 'auth']);
$routes->post('/crud-productos', 'ProductoController::index', ['filter' => 'auth']);

// ---- Alta de producto ----
$routes->get('/alta-producto', 'ProductoController::create_alta_producto', ['filter' => 'auth']);
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation', ['filter' => 'auth']);

// ---- Edición y eliminación de producto ----
$routes->get('/delete-producto/(:num)', 'ProductoController::delete_producto/$1', ['filter' => 'auth']);
$routes->get('/activar-producto/(:num)', 'ProductoController::activar_producto/$1', ['filter' => 'auth']);
$routes->get('/editar-producto/(:num)', 'ProductoController::index_editar_producto/$1', ['filter' => 'auth']);
$routes->post('modificar-producto/(:num)', 'ProductoController::modificar_producto/$1', ['filter' => 'auth']);


// -------------------- Funcionalidad del Carrito --------------------

// ---- Catálogo y visualización ----
$routes->get('/todos_p','carrito_controller::catalogo', ['filter' => 'auth']);
$routes->get('/muestro','carrito_controller::muestra', ['filter' => 'auth']);

// ---- Operaciones sobre el carrito ----
$routes->get('/carrito_actualiza','carrito_controller::actualiza_carrito', ['filter' => 'auth']);
$routes->post('/carrito/add','carrito_controller::add', ['filter' => 'auth']);
$routes->get('/carrito_elimina/(:any)','carrito_controller::remove/$1', ['filter' => 'auth']);
$routes->get('/borrar','carrito_controller::borrar_carrito', ['filter' => 'auth']);

// ---- Suma y resta de ítems ----
$routes->get('carrito_suma/(:any)', 'carrito_controller::suma/$1', ['filter' => 'auth']);
$routes->get('carrito_resta/(:any)', 'carrito_controller::resta/$1', ['filter' => 'auth']);


// -------------------- Gestión de Consultas --------------------
$routes->get('/lista-consultas', 'ConsultaController::index', ['filter' => 'auth']);
$routes->get('/consultas', 'ConsultaController::listarConsultas', ['filter' => 'auth']);
$routes->post('/consultas/eliminar/(:num)', 'ConsultaController::eliminarConsulta/$1', ['filter' => 'auth']);
