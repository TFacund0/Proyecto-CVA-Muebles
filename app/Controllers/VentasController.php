<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;
use App\Models\VentasCabecera_model;
use App\Models\VentasDetalle_model;
use App\Models\Productos_model;

class VentasController extends BaseController {
    public function __construct() {
        helper(['url', 'form']);
    }

    public function index_ventas() {
        $data = [];
        $ventasDetalle = new VentasDetalle_model();
        $data['ventas'] = $ventasDetalle->getDetallesAll();

        // Calcula el subtotal para cada venta
        foreach ($data['ventas'] as &$venta) {
            $venta['subtotal'] = $venta['cantidad'] * $venta['precio'];
        }

        return view('front/main', [
            'title' => 'Ventas',
            'content' => view('back/ventas/detalleVentas', $data),
        ]);
    }

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
            return redirect()->to('ventas_detalle');
        }

        if(empty($productos_validos)) {
            $session->setFlashdata('error', 'No hay productos válidos en el carrito.');
            return redirect()->to('ventas_detalle');
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
        return redirect()->to('ventas_detalle');
    }

    public function ver_factura($venta_id) {
        $detalles_venta = new VentasDetalle_model();
        $data['venta'] = $detalles_venta->getDetalles($venta_id);

        return view('front/main', [
            'title' => 'Mi Compra',
            'content' => view('back/ventas/vista_compras', $data)
        ]);
    }

    public function ver_facturas_usuario($id_usuario) {
        $ventasModel = new VentasCabecera_model();
        $data['ventas'] = $ventasModel->getVentas($id_usuario);

        return view('front/main', [
            'title' => 'Todas mis Compras',
            'content' => view('back/ventas/ver_factura_usuario', $data)
        ]);
    }
}
