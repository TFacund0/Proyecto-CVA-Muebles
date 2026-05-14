<?php

namespace App\Services;

use App\Models\VentasCabeceraModel;
use App\Models\VentasDetalleModel;
use App\Models\ProductoModel;
use App\Models\VentasPagosModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

/**
 * Servicio para manejar la lógica de negocio relacionada con las ventas.
 */
class VentasService
{
    protected $ventasModel;
    protected $detalleModel;
    protected $productoModel;
    protected $pagosModel;
    protected $db;

    public function __construct()
    {
        $this->ventasModel = new VentasCabeceraModel();
        $this->detalleModel = new VentasDetalleModel();
        $this->productoModel = new ProductoModel();
        $this->pagosModel = new VentasPagosModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Obtiene todas las ventas con estadísticas procesadas para el panel.
     */
    public function getVentasConEstadisticas()
    {
        $ventas = $this->ventasModel->getVentas();
        $currentMonth = date('m');
        $currentYear = date('Y');

        $counts = [
            'total'      => count($ventas),
            'mensuales'  => 0,
            'pendientes' => 0,
            'en_proceso' => 0,
            'terminados' => 0,
            'ingresos'   => 0
        ];

        foreach ($ventas as &$venta) {
            $ventaDate = strtotime($venta['fecha']);
            
            if (date('m', $ventaDate) == $currentMonth && date('Y', $ventaDate) == $currentYear) {
                $counts['mensuales']++;
                $counts['ingresos'] += $venta['total_venta'];
            }

            if ($venta['estado'] == 'PENDIENTE') $counts['pendientes']++;
            if ($venta['estado'] == 'EN_PROCESO') $counts['en_proceso']++;
            if ($venta['estado'] == 'TERMINADO' || $venta['estado'] == 'ENTREGADO') $counts['terminados']++;
            
            $nombre_completo = ($venta['nombre'] ?? '') . ' ' . ($venta['apellido'] ?? '');
            $venta['search_data'] = strtolower(esc($venta['id'] . ' ' . $nombre_completo . ' ' . ($venta['usuario'] ?? '')));
        }

        return [
            'ventas' => $ventas,
            'counts' => $counts
        ];
    }

    /**
     * Procesa una venta completa: valida stock, crea registros y actualiza inventario.
     */
    public function procesarVenta($usuario_id, $carrito)
    {
        if (empty($carrito)) {
            return ['status' => 'error', 'message' => 'El carrito está vacío.'];
        }

        $productos_validos = [];
        $productos_sin_stock = [];
        $total = 0;

        foreach ($carrito as $item) {
            $producto = $this->productoModel->find($item['id']);
            if ($producto && $producto['stock'] >= $item['qty']) {
                $productos_validos[] = $item;
                $total += $item['subtotal'];
            } else {
                $productos_sin_stock[] = $item['name'];
            }
        }

        if (!empty($productos_sin_stock)) {
            return [
                'status' => 'error',
                'message' => 'Stock insuficiente para: ' . implode(', ', $productos_sin_stock)
            ];
        }

        $this->db->transStart();
        try {
            $venta_id = $this->ventasModel->insert([
                'usuario_id' => $usuario_id,
                'fecha' => date('Y-m-d H:i:s'),
                'total_venta' => $total,
                'estado' => 'PENDIENTE'
            ]);

            foreach ($productos_validos as $item) {
                $this->detalleModel->insert([
                    'venta_id' => $venta_id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['qty'],
                    'precio' => $item['price'],
                ]);

                $producto = $this->productoModel->find($item['id']);
                $this->productoModel->update($item['id'], ['stock' => $producto['stock'] - $item['qty']]);
            }

            $this->db->transComplete();
            return ['status' => 'success', 'total' => $total, 'venta_id' => $venta_id];
        } catch (\Exception $e) {
            $this->db->transRollback();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Obtiene el detalle completo de una venta para gestión administrativa.
     */
    public function getGestionDetalle($venta_id)
    {
        $venta = $this->ventasModel->getVentas($venta_id)[0] ?? null;
        if (!$venta) return null;

        $detalles = $this->detalleModel->getDetalles($venta_id);
        $pagos = $this->pagosModel->getPagosPorVenta($venta_id);
        $total_pagado = $this->pagosModel->getTotalPagado($venta_id);

        return [
            'venta' => $venta,
            'detalles' => $detalles,
            'pagos' => $pagos,
            'total_pagado' => $total_pagado,
            'saldo_pendiente' => $venta['total_venta'] - $total_pagado
        ];
    }

    /**
     * Actualiza el estado de una venta.
     */
    public function actualizarEstado($venta_id, $estado)
    {
        return $this->ventasModel->update($venta_id, ['estado' => $estado]);
    }

    /**
     * Registra un pago para una venta.
     */
    public function registrarPago($venta_id, $monto, $nota = '')
    {
        return $this->pagosModel->insert([
            'venta_id' => $venta_id,
            'monto'    => $monto,
            'nota'     => $nota
        ]);
    }

    /**
     * Actualiza las observaciones de una venta.
     */
    public function actualizarObservaciones($venta_id, $observaciones)
    {
        return $this->ventasModel->update($venta_id, ['observaciones' => $observaciones]);
    }

    /**
     * Obtiene estadísticas agregadas para el dashboard.
     */
    public function getDashboardStats()
    {
        return [
            'PENDIENTE'  => $this->ventasModel->where('estado', 'PENDIENTE')->countAllResults(),
            'EN_PROCESO' => $this->ventasModel->where('estado', 'EN_PROCESO')->countAllResults(),
            'TERMINADO'  => $this->ventasModel->where('estado', 'TERMINADO')->countAllResults(),
            'ENTREGADO'  => $this->ventasModel->where('estado', 'ENTREGADO')->countAllResults(),
        ];
    }

    /**
     * Registra un pedido personalizado.
     */
    public function registrarPedidoPersonalizado($data)
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario_gen = $usuarioModel->where('usuario', 'cliente_whatsapp')->first();
        if (!$usuario_gen) return ['status' => 'error', 'message' => 'No se encontró el usuario genérico.'];

        $this->db->transStart();
        try {
            $observaciones = "CLIENTE: " . $data['nombre_cliente'] . "\n" . $data['detalles_obra'];
            $venta_id = $this->ventasModel->insert([
                'usuario_id'    => $usuario_gen['id_usuario'],
                'total_venta'   => $data['total_venta'],
                'estado'        => 'PENDIENTE',
                'observaciones' => $observaciones,
                'fecha'         => date('Y-m-d H:i:s')
            ]);

            $this->detalleModel->insert([
                'venta_id' => $venta_id, 'producto_id' => null, 'cantidad' => 1, 'precio' => $data['total_venta']
            ]);

            if ($data['monto_sena'] > 0) {
                $this->registrarPago($venta_id, $data['monto_sena'], 'Seña inicial - Pedido Manual');
            }

            $this->db->transComplete();
            return ['status' => 'success', 'venta_id' => $venta_id];
        } catch (\Exception $e) {
            $this->db->transRollback();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
    /**
     * Obtiene el historial de ventas de un usuario específico.
     */
    public function getVentasPorUsuario($usuario_id)
    {
        return $this->ventasModel->getVentas(null, $usuario_id);
    }
}
