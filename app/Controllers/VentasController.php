<?php

namespace App\Controllers;

use App\Models\VentasCabeceraModel;
use App\Models\VentasDetalleModel;

/**
 * Controlador para gestión de ventas refactorizado para usar Capa de Servicios.
 */
class VentasController extends BaseController {

    protected $ventasService;

    public function __construct() {
        helper(['url', 'form']);
        $this->ventasService = new \App\Services\VentasService();
    }

    /**
     * Muestra el listado de ventas con estadísticas procesadas por el servicio.
     */
    public function index_ventas() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $resultado = $this->ventasService->getVentasConEstadisticas();
        
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        
        return view('back/sales/detalleVentas', [
            'ventas'    => $resultado['ventas'],
            'counts'    => $resultado['counts'],
            'nombreMes' => $meses[(int)date('m') - 1],
            'title'     => 'Control de Pedidos'
        ]);
    }

    /**
     * Procesa el registro de una nueva venta delegando al servicio.
     */
    public function registrar_venta() {
        $cartController = new CarritoController();
        $resultado = $this->ventasService->procesarVenta(session()->get('id_usuario'), $cartController->devolver_carrito());

        if ($resultado['status'] === 'success') {
            $cartController->borrar_carrito();
            return redirect()->to('/muestro')->with('success', 'Venta registrada exitosamente. Total: ' . $resultado['total']);
        } else {
            return redirect()->to('/muestro')->with('error', $resultado['message']);
        }
    }

    /**
     * Muestra la factura de una venta específica.
     */
    public function ver_factura($venta_id) {
        $data = $this->ventasService->getGestionDetalle($venta_id);
        if (!$data) return redirect()->to('/productos')->with('error', 'Pedido no encontrado.');

        return view('back/sales/ver_factura_usuario', [
            'venta' => $data['detalles'],
            'title' => 'Mi Compra'
        ]);
    }

    /**
     * Muestra todas las facturas del usuario actual.
     */
    public function ver_facturas_usuario() {
        $id_usuario = session()->get('id_usuario');
        $ventas = $this->ventasService->getVentasPorUsuario($id_usuario);

        return view('back/sales/vistaCompras', [
            'ventas' => $ventas,
            'title'  => 'Todas mis Compras'
        ]);
    }

    /**
     * Actualiza el estado de una venta delegando al servicio.
     */
    public function actualizar_estado($venta_id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $nuevo_estado = $this->request->getPost('estado');
        $this->ventasService->actualizarEstado($venta_id, $nuevo_estado);

        return redirect()->back()->with('success', 'Estado de pedido actualizado a: ' . $nuevo_estado);
    }

    /**
     * Muestra estadísticas agregadas del taller.
     */
    public function estadisticas() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        // Podríamos crear un ConsultaService, por ahora mantenemos el modelo para esta métrica específica
        $consultasModel = new \App\Models\ConsultaModel();
        
        return view('back/sales/estadisticas', [
            'stats' => $this->ventasService->getDashboardStats(),
            'total_consultas' => $consultasModel->where('activo', 'SI')->countAllResults(),
            'title' => 'Estadísticas del Taller'
        ]);
    }

    /**
     * Muestra el formulario para registrar un pedido manual.
     */
    public function nuevo_pedido_personalizado() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        return view('back/sales/nuevo_pedido_personalizado', ['title' => 'Nuevo Pedido Personalizado']);
    }

    /**
     * Procesa el registro de un pedido manual delegando al servicio.
     */
    public function guardar_pedido_personalizado() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $resultado = $this->ventasService->registrarPedidoPersonalizado($this->request->getPost());

        if ($resultado['status'] === 'success') {
            return redirect()->to('/ventas/gestion/' . $resultado['venta_id'])->with('success', 'Pedido personalizado registrado correctamente.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $resultado['message']);
        }
    }

    /**
     * Vista de gestión detallada para el administrador.
     */
    public function ver_gestion_pedido($venta_id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $data = $this->ventasService->getGestionDetalle($venta_id);
        if (!$data) return redirect()->to('/ventas-list')->with('error', 'Pedido no encontrado.');

        $data['title'] = 'Gestión de Pedido #' . $venta_id;
        return view('back/sales/gestion_pedido_admin', $data);
    }

    /**
     * Registra un pago delegando al servicio.
     */
    public function registrar_pago() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $this->ventasService->registrarPago(
            $this->request->getPost('venta_id'),
            $this->request->getPost('monto'),
            $this->request->getPost('nota')
        );

        return redirect()->back()->with('success', 'Pago registrado exitosamente.');
    }

    /**
     * Actualiza las observaciones delegando al servicio.
     */
    public function guardar_observaciones() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $this->ventasService->actualizarObservaciones(
            $this->request->getPost('venta_id'),
            $this->request->getPost('observaciones')
        );

        return redirect()->back()->with('success', 'Detalles del pedido actualizados.');
    }
}
