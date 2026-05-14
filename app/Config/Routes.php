<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// -------------------- RUTA PRINCIPAL --------------------
$routes->get('/', 'HomeController::index');


// ====================================================================
//                      RUTAS SIN FILTRO DE AUTENTICACIÓN
// ====================================================================

// -------------------- Páginas informativas --------------------
$routes->get('/quienesSomos', 'PagesController::quienesSomos');
$routes->get('/comercializacion', 'PagesController::comercializacion');
$routes->get('/informacionContacto', 'PagesController::informacionContacto');
$routes->get('/terminosYCondiciones', 'PagesController::terminosYCondiciones');
$routes->get('/beneficios', 'PagesController::beneficios');
$routes->get('/productos', 'PagesController::productos');
$routes->get('/galeria', 'GaleriaController::index');
$routes->get('/galeria/setup', 'GaleriaController::setupDb');
$routes->post('/galeria/subir', 'GaleriaController::subir', ['filter' => 'auth']);
$routes->get('/admin/galeria', 'GaleriaController::admin_index', ['filter' => 'auth']);
$routes->get('/admin/galeria/aprobar/(:num)', 'GaleriaController::aprobar/$1', ['filter' => 'auth']);
$routes->get('/admin/galeria/eliminar/(:num)', 'GaleriaController::eliminar/$1', ['filter' => 'auth']);
$routes->get('/producto/detalle/(:num)', 'ProductoController::ver_detalle/$1');

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
$routes->get('/ventas_lista', 'VentasController::ver_facturas_usuario', ['filter' => 'auth']);
$routes->get('/factura/(:num)', 'VentasController::ver_factura/$1', ['filter' => 'auth']);
$routes->get('/carrito_comprar', 'VentasController::registrar_venta', ['filter' => 'auth']);
$routes->post('/ventas/actualizar_estado/(:num)', 'VentasController::actualizar_estado/$1', ['filter' => 'auth']);
$routes->get('/admin-dashboard', 'VentasController::estadisticas', ['filter' => 'auth']);
$routes->get('/ventas/gestion/(:num)', 'VentasController::ver_gestion_pedido/$1', ['filter' => 'auth']);
$routes->post('/ventas/registrar_pago', 'VentasController::registrar_pago', ['filter' => 'auth']);
$routes->post('/ventas/guardar_observaciones', 'VentasController::guardar_observaciones', ['filter' => 'auth']);
$routes->get('/ventas/nuevo-personalizado', 'VentasController::nuevo_pedido_personalizado', ['filter' => 'auth']);
$routes->post('/ventas/guardar-personalizado', 'VentasController::guardar_pedido_personalizado', ['filter' => 'auth']);


// -------------------- Gestión de Usuarios --------------------
$routes->get('/crud-usuarios', 'UsuarioController::index', ['filter' => 'auth']);
$routes->get('/editar-usuario/(:num)', 'UsuarioController::editar_usuario/$1', ['filter' => 'auth']);
$routes->get('/delete-usuario/(:num)', 'UsuarioController::delete_usuario/$1', ['filter' => 'auth']);
$routes->get('/activar-usuario/(:num)', 'UsuarioController::activar_usuario/$1', ['filter' => 'auth']);


// -------------------- Perfil de Usuario --------------------
$routes->get('/perfil', 'UsuarioController::index_perfil', ['filter' => 'auth']);
$routes->post('/guardarCambios', 'UsuarioController::guardarCambios', ['filter' => 'auth']);


// -------------------- Gestión de Productos --------------------
$routes->get('/crud-productos', 'ProductoController::index', ['filter' => 'auth']);
$routes->get('/alta-producto', 'ProductoController::create_alta_producto', ['filter' => 'auth']);
$routes->post('/enviar-alta-producto', 'ProductoController::formValidation', ['filter' => 'auth']);
$routes->get('/delete-producto/(:num)', 'ProductoController::delete_producto/$1', ['filter' => 'auth']);
$routes->get('/activar-producto/(:num)', 'ProductoController::activar_producto/$1', ['filter' => 'auth']);
$routes->get('/editar-producto/(:num)', 'ProductoController::index_editar_producto/$1', ['filter' => 'auth']);
$routes->post('modificar-producto/(:num)', 'ProductoController::modificar_producto/$1', ['filter' => 'auth']);


// -------------------- Gestión de Categorías --------------------
$routes->get('/crud-categorias', 'CategoriaController::index', ['filter' => 'auth']);
$routes->post('/admin/categorias/guardar', 'CategoriaController::guardar', ['filter' => 'auth']);
$routes->post('/admin/categorias/editar/(:num)', 'CategoriaController::editar/$1', ['filter' => 'auth']);
$routes->get('/admin/categorias/eliminar/(:num)', 'CategoriaController::eliminar/$1', ['filter' => 'auth']);
$routes->get('/admin/categorias/toggle/(:num)', 'CategoriaController::toggle/$1', ['filter' => 'auth']);



// -------------------- Funcionalidad del Carrito --------------------
$routes->get('/muestro','CarritoController::muestra', ['filter' => 'auth']);
$routes->post('/carrito/add','CarritoController::add', ['filter' => 'auth']);
$routes->get('/carrito_elimina/(:any)','CarritoController::remove/$1', ['filter' => 'auth']);
$routes->get('/borrar','CarritoController::borrar_carrito', ['filter' => 'auth']);
$routes->get('carrito_suma/(:any)', 'CarritoController::suma/$1', ['filter' => 'auth']);
$routes->get('carrito_resta/(:any)', 'CarritoController::resta/$1', ['filter' => 'auth']);


// -------------------- Gestión de Favoritos (Wishlist) --------------------
$routes->get('/favoritos/toggle/(:num)', 'FavoritosController::toggleFavorito/$1', ['filter' => 'auth']);
$routes->get('/mis-favoritos', 'FavoritosController::misFavoritos', ['filter' => 'auth']);


// -------------------- Gestión de Consultas --------------------
$routes->get('/consultas', 'ConsultaController::index', ['filter' => 'auth']);
$routes->get('/consultas/eliminar/(:num)', 'ConsultaController::eliminarConsulta/$1', ['filter' => 'auth']);

