<?php

namespace App\Models;
use CodeIgniter\Model;

class Productos_model extends Model 
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['nombre_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    public function getProductoAll() {
        return $this->select('productos.*, categorias.descripcion as categoria')
                    ->join('categorias', 'categorias.id_categoria = productos.categoria_id')
                    ->findAll();
    }

    public function getBuilderProductos() {
        $db = \Config\Database::conect();
        $builder = $db->table('productos');
        $builder->select('*');
        $builder->join('categorias', 'categorias.id = productos.categoria_id');
        
        return $builder;
    }

    public function getProducto($id = null) {
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function updateStock($id = null, $stock = null) {
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $builder->set('productos.stock', $stock);
        
        $builder->update();
    }
}