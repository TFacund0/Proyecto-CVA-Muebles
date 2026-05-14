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
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta', 'estado', 'observaciones', 'tipo_pedido'];

    public function getVentas($id = null, $id_usuario = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');
        $builder->select('ventas_cabecera.id as id_venta, ventas_cabecera.fecha, ventas_cabecera.usuario_id, ventas_cabecera.total_venta, ventas_cabecera.estado, ventas_cabecera.observaciones, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.usuario');
        
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');

        if ($id != null) {
            $builder->where('ventas_cabecera.id', $id);
        }

        if ($id_usuario != null) {
            $builder->where('ventas_cabecera.usuario_id', $id_usuario);
        }
        
        $query = $builder->get();
        $results = $query->getResultArray();

        // Mantenemos compatibilidad con el resto del sistema que espera la clave 'id'
        foreach ($results as &$row) {
            $row['id'] = $row['id_venta'];
        }

        return $results;
    }
}
