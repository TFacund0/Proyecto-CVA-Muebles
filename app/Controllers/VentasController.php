<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;
use App\Models\VentasCabecera_model;
use App\Models\VentasDetalle_model;
use App\Models\Productos_model;
use App\Models\VentasPagos_model;

/**
 * Controlador para gestión de ventas
 * 
 * Funcionalidades:
 * - Listado y filtrado de ventas
 * - Registro de nuevas ventas
 * - Visualización de facturas
 * - Gestión de estados (Artisan Panel)
 * - Estadísticas de producción
 */
class VentasController extends BaseController {

    /**
     * Constructor - Inicializa helpers
     */
    public function __construct() {
        helper(['url', 'form']);
    }

    /**
     * Muestra el listado de ventas con filtros
     * @return View Vista de detalle de ventas
     */
    public function index_ventas() {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        helper('text');
        $request = service('request');

        $ventasDetalle = new VentasDetalle_model();

        // Parámetros de filtrado
        $search = strtolower(trim($request->getGet('search') ?? ''));
        $tipo = $request->getGet('filtro_tipo') ?? '';
        $estado_filtro = $request->getGet('estado') ?? '';

        $ventas = $ventasDetalle->getDetallesAll();
        $ventas_filtradas = [];

        foreach ($ventas as $venta) {
            $coincide = true;

            if ($search) {
                switch ($tipo) {
                    case 'id':
                        $coincide = strpos((string) $venta['venta_id'], $search) !== false;
                        break;
                    case 'usuario':
                        $coincide = stripos($venta['usuario'], $search) !== false;
                        break;
                    case 'descripcion':
                        $coincide = stripos($venta['nombre_prod'], $search) !== false;
                        break;
                    default:
                        $coincide = true;
                }
            }

            if ($estado_filtro && $venta['estado'] != $estado_filtro) {
                $coincide = false;
            }

            if ($coincide) {
                // Calcula subtotal directamente en el foreach
                $venta['subtotal'] = $venta['cantidad'] * $venta['precio'];
                $ventas_filtradas[] = $venta;
            }
        }

        return view('front/main', [
            'title' => 'Ventas',
            'content' => view('back/ventas/detalleVentas', [
                'ventas' => $ventas_filtradas, 
                'search' => $search, 
                'filtro_tipo' => $tipo,
                'estado_filtro' => $estado_filtro
            ])
        ]);
    }

    /**
     * Procesa el registro de una nueva venta
     * @return Redirect Redirección con mensaje de estado
     */
    public function registrar_venta() {
        $session = session();
        require(APPPATH . 'Controllers/carrito_controller.php');
        $cartController = new carrito_controller();
        $carrito_contents = $cartController->devolver_carrito();

        $productoModel = new Productos_model();
        $ventasModel = new VentasCabecera_model();
        $ventasDetalleModel = new VentasDetalle_model();

        $productos_validos = [];
        $productos_sin_stock = [];
        $total = 0;

        foreach ($carrito_contents as $item) {
            $producto = $productoModel->getProducto($item['id']);

            if ($producto && $producto['stock'] >= $item['qty']) {
                $productos_validos[] = $item;
                $total += $item['subtotal'];
            } else {
                $productos_sin_stock[] = $item['name'];
                $cartController->eliminar_item($item['rowid']);
            }
        }

        if(!empty($productos_sin_stock)) {
            $mensaje = 'Los siguientes productos no tienen stock suficiente: ' . implode(', ', $productos_sin_stock);
            $session->setFlashdata('error', $mensaje);
            return redirect()->to('muestro');
        }

        if(empty($productos_validos)) {
            $session->setFlashdata('error', 'No hay productos válidos en el carrito.');
            return redirect()->to('muestro');
        }

        $nueva_venta = [
            'usuario_id' => $session->get('id_usuario'),
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total
        ];

        $venta_id = $ventasModel->insert($nueva_venta);

        //Registrar detalles de la venta y actualizar stock
        foreach ($productos_validos as $item) {
            $detalle_venta = [
                'venta_id' => $venta_id,
                'producto_id' => $item['id'],
                'cantidad' => $item['qty'],
                'precio' => $item['price'],
            ];
            $ventasDetalleModel->insert($detalle_venta);

            $producto = $productoModel->getProducto($item['id']);
            $productoModel->update($item['id'], ['stock' => $producto['stock'] - $item['qty']]);
        }
        
        //Vaciar Carrito y mostrar confirmación
        $cartController->borrar_carrito();
        $session->setFlashdata('success', 'Venta registrada exitosamente. Total: ' . $total);
        return redirect()->to('muestro');
    }

    /**
     * Muestra la factura de una venta específica
     * @param int $venta_id ID de la venta
     * @return View Vista de factura
     */
    public function ver_factura($venta_id) {
        $detalles_venta = new VentasDetalle_model();
        $data['venta'] = $detalles_venta->getDetalles($venta_id);

        return view('front/main', [
            'title' => 'Mi Compra',
            'content' => view('back/ventas/ver_factura_usuario', $data)
        ]);
    }

    public function ver_facturas_usuario() {
        $id_usuario = session()->get('id_usuario');
        $ventasModel = new VentasCabecera_model();
        $data['ventas'] = $ventasModel->getVentas(NULL, $id_usuario);

        return view('front/main', [
            'title' => 'Todas mis Compras',
            'content' => view('back/ventas/vistaCompras', $data)
        ]);
    }

    /**
     * @brief Actualiza el estado de una venta (Artisan Panel)
     * @param int $venta_id ID de la venta
     * @return Redirect Redirección con mensaje de éxito
     */
    public function actualizar_estado($venta_id) {
        $perfil = session()->get('perfil_id');
        if ($perfil != 1) return redirect()->to('/login');

        $nuevo_estado = $this->request->getPost('estado');
        $ventasModel = new VentasCabecera_model();
        
        $ventasModel->update($venta_id, ['estado' => $nuevo_estado]);

        return redirect()->back()->with('success', 'Estado de pedido actualizado a: ' . $nuevo_estado);
    }

    /**
     * @brief Muestra estadísticas de carga de trabajo y pedidos
     * @return View Vista de estadísticas
     */
    public function estadisticas() {
        $perfil = session()->get('perfil_id');
        if ($perfil != 1) return redirect()->to('/login');

        $ventasModel = new VentasCabecera_model();
        
        // Obtener conteo por estado
        $data['stats'] = [
            'PENDIENTE'  => $ventasModel->where('estado', 'PENDIENTE')->countAllResults(),
            'EN_PROCESO' => $ventasModel->where('estado', 'EN_PROCESO')->countAllResults(),
            'TERMINADO'  => $ventasModel->where('estado', 'TERMINADO')->countAllResults(),
            'ENTREGADO'  => $ventasModel->where('estado', 'ENTREGADO')->countAllResults(),
        ];

        return view('front/main', [
            'title' => 'Estadísticas del Taller',
            'content' => view('back/ventas/estadisticas', $data)
        ]);
    }

    /**
     * @brief Vista de gestión detallada para el administrador (Artisan Panel)
     * @param int $venta_id ID de la venta
     * @return View Vista de gestión
     */
    public function ver_gestion_pedido($venta_id) {
        $perfil = session()->get('perfil_id');
        if ($perfil != 1) return redirect()->to('/login');

        $ventasModel = new VentasCabecera_model();
        $ventasDetalle = new VentasDetalle_model();
        $pagosModel = new VentasPagos_model();

        $data['venta'] = $ventasModel->getVentas($venta_id)[0] ?? null;
        if (!$data['venta']) return redirect()->to('ventas-list')->with('error', 'Pedido no encontrado.');

        $data['detalles'] = $ventasDetalle->getDetalles($venta_id);
        $data['pagos'] = $pagosModel->getPagosPorVenta($venta_id);
        $data['total_pagado'] = $pagosModel->getTotalPagado($venta_id);
        $data['saldo_pendiente'] = $data['venta']['total_venta'] - $data['total_pagado'];

        return view('front/main', [
            'title' => 'Gestión de Pedido #' . $venta_id,
            'content' => view('back/ventas/gestion_pedido_admin', $data)
        ]);
    }

    /**
     * @brief Registra un pago parcial o total para una venta
     * @return Redirect Redirección con mensaje de éxito
     */
    public function registrar_pago() {
        $perfil = session()->get('perfil_id');
        if ($perfil != 1) return redirect()->to('/login');

        $venta_id = $this->request->getPost('venta_id');
        $monto = $this->request->getPost('monto');
        $nota = $this->request->getPost('nota');

        $pagosModel = new VentasPagos_model();
        $pagosModel->insert([
            'venta_id' => $venta_id,
            'monto'    => $monto,
            'nota'     => $nota
        ]);

        return redirect()->back()->with('success', 'Pago registrado exitosamente.');
    }

    /**
     * @brief Actualiza las observaciones/detalles de un pedido
     * @return Redirect Redirección con mensaje de éxito
     */
    public function guardar_observaciones() {
        $perfil = session()->get('perfil_id');
        if ($perfil != 1) return redirect()->to('/login');

        $venta_id = $this->request->getPost('venta_id');
        $observaciones = $this->request->getPost('observaciones');

        $ventasModel = new VentasCabecera_model();
        $ventasModel->update($venta_id, ['observaciones' => $observaciones]);

        return redirect()->back()->with('success', 'Detalles del pedido actualizados.');
    }
}