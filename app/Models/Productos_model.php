<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos_model extends Model {
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['nombre_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    public function getProductoAll() {
        return $this->select('productos.*, categorias.descripcion as categoria')
                    ->join('categorias', 'categorias.id_categoria = productos.categoria_id')
                    ->findAll();;
    }
}