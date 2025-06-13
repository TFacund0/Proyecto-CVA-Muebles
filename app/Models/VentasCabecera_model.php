<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasCabecera_model extends Model {
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];

    public function getVentas($id = null, $id_usuario = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');
        $builder->select('*');
        
        $builder->join('usuarios', 'usuarios.id = ventas_cabecera.usuario_id');

        if ($id != null) {
            $builder->where('ventas_cabecera.id', $id);
        }

        if ($id_usuario != null) {
            $builder->where('ventas_cabecera.usuario_id', $id_usuario);
        }
        
        $query = $builder->get();
        
        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        } else {
            return [];
        }
    }
}
