<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasDetalleModel extends Model {
    protected $table = 'ventas_detalle';
    protected $primaryKey = 'id';
    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    public function getDetallesAll() {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_detalle');
        $builder->select('ventas_detalle.id as id_detalle, ventas_detalle.venta_id, ventas_detalle.producto_id, ventas_detalle.cantidad, ventas_detalle.precio, ventas_cabecera.fecha, ventas_cabecera.estado, productos.nombre_prod, usuarios.usuario as nombre_usuario');
        
        $builder->join('ventas_cabecera', 'ventas_cabecera.id = ventas_detalle.venta_id');
        $builder->join('productos', 'productos.id_producto = ventas_detalle.producto_id');
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');

        $query = $builder->get();
        $results = $query->getResultArray();

        foreach ($results as &$row) {
            $row['id'] = $row['id_detalle'];
        }

        return $results;
    }

    public function getDetalles($id = null, $id_usuario = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_detalle');
        $builder->select('ventas_detalle.id as id_detalle, ventas_detalle.venta_id, ventas_detalle.producto_id, ventas_detalle.cantidad, ventas_detalle.precio, ventas_cabecera.fecha, ventas_cabecera.estado, productos.nombre_prod, usuarios.usuario as nombre_usuario');
        
        $builder->join('ventas_cabecera', 'ventas_cabecera.id = ventas_detalle.venta_id');
        $builder->join('productos', 'productos.id_producto = ventas_detalle.producto_id');
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');

        if ($id != null) {
            $builder->where('ventas_cabecera.id', $id);
        }

        if ($id_usuario != null) {
            $builder->where('ventas_cabecera.usuario_id', $id_usuario);
        }

        $query = $builder->get();
        $results = $query->getResultArray();

        foreach ($results as &$row) {
            $row['id'] = $row['id_detalle'];
        }

        return $results;
    }
}