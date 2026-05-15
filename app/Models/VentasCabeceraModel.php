<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * @class VentasCabeceraModel
 * @brief Modelo para la gestión de la cabecera de ventas.
 */
class VentasCabeceraModel extends Model {
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta', 'estado', 'observaciones', 'tipo_pedido', 'estado_aprobacion'];

    protected $validationRules = [
        'usuario_id'  => 'required|numeric',
        'total_venta' => 'required|numeric',
        'estado'      => 'required|alpha_dash'
    ];

    public function getVentas($id = null, $id_usuario = null) {
        $builder = $this->select('ventas_cabecera.id as id_venta, ventas_cabecera.fecha, ventas_cabecera.usuario_id, ventas_cabecera.total_venta, ventas_cabecera.estado, ventas_cabecera.estado_aprobacion, ventas_cabecera.tipo_pedido, ventas_cabecera.observaciones, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.usuario')
                        ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id', 'left');

        if ($id != null) {
            $builder->where('ventas_cabecera.id', $id);
        }

        if ($id_usuario != null) {
            $builder->where('ventas_cabecera.usuario_id', $id_usuario);
        }
        
        $results = $builder->orderBy('ventas_cabecera.fecha', 'DESC')->findAll();

        // Mantenemos compatibilidad con el resto del sistema que espera la clave 'id'
        foreach ($results as &$row) {
            $row['id'] = $row['id_venta'];
        }

        return $results;
    }
}
