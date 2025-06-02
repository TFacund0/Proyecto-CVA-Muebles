<?php

namespace App\Models;
use CodeIgniter\Model;

class Usuarios_model extends Model 
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'apellido', 'usuario', 'email', 'pass', 'imagen', 'perfil_id', 'baja'];

    public function getUsuariosAll() {
        return $this->select('usuarios.*, perfiles.descripcion as perfil')
                    ->join('perfiles', 'perfiles.id = usuarios.perfil_id')
                    ->findAll();
    }
}