<?php

namespace App\Models;

use CodeIgniter\Model;

class Categorias_model extends Model {
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $allowedFields = ['descripcion', 'activo'];

    public function getCategorias() {
        return $this->findAll();
    }
}