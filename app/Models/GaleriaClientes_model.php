<?php
namespace App\Models;
use CodeIgniter\Model;

class GaleriaClientes_model extends Model {
    protected $table = 'galeria_clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'imagen', 'comentario', 'fecha', 'activo'];

    public function getActivas() {
        return $this->select('galeria_clientes.*, usuarios.nombre')
                    ->join('usuarios', 'usuarios.id_usuario = galeria_clientes.usuario_id')
                    ->where('activo', 'SI')
                    ->orderBy('fecha', 'DESC')
                    ->findAll();
    }
}
