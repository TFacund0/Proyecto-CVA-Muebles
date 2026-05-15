<?php

namespace App\Services;

use App\Models\UsuarioModel;

/**
 * Servicio para manejar la lógica de negocio relacionada con los usuarios.
 */
class UsuarioService
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Autentica a un usuario.
     */
    public function autenticar($login, $password)
    {
        $usuario = $this->usuarioModel->where('email', $login)
                                      ->orWhere('usuario', $login)
                                      ->first();

        if (!$usuario) {
            return ['status' => 'error', 'message' => 'Email o nombre de usuario incorrectos'];
        }

        if ($usuario['baja'] == 'SI') {
            return ['status' => 'error', 'message' => 'Usuario dado de baja'];
        }

        if (!password_verify($password, $usuario['pass'])) {
            return ['status' => 'error', 'message' => 'Contraseña Incorrecta'];
        }

        return [
            'status' => 'success',
            'data' => [
                'id_usuario' => $usuario['id_usuario'],
                'nombre'     => $usuario['nombre'],
                'apellido'   => $usuario['apellido'],
                'email'      => $usuario['email'],
                'usuario'    => $usuario['usuario'],
                'perfil_id'  => $usuario['perfil_id'],
                'imagen'     => $usuario['imagen'],
                'logged_in'  => TRUE
            ]
        ];
    }

    /**
     * Obtiene el listado de usuarios con estadísticas procesadas para el panel.
     */
    public function getUsuariosConStats()
    {
        $usuarios = $this->usuarioModel->getUsuariosAll();

        $counts = [
            'total' => count($usuarios),
            'activos' => 0,
            'admins' => 0,
            'suspendidos' => 0
        ];

        foreach ($usuarios as $u) {
            if ($u['baja'] == 'NO') $counts['activos']++;
            else $counts['suspendidos']++;
            
            if ($u['perfil_id'] == 1) $counts['admins']++;
        }

        return [
            'usuarios' => $usuarios,
            'counts' => $counts
        ];
    }

    /**
     * Registra un nuevo usuario.
     */
    public function registrarUsuario($data)
    {
        try {
            $userData = [
                'nombre'    => $data['name'],
                'apellido'  => $data['surname'],
                'usuario'   => $data['user'],
                'email'     => $data['email'],
                'pass'      => password_hash($data['pass'], PASSWORD_DEFAULT),
                'perfil_id' => 2,
                'baja'      => 'NO'
            ];

            return $this->usuarioModel->insert($userData) 
                ? ['status' => 'success', 'message' => 'Usuario registrado con éxito.']
                : ['status' => 'error', 'message' => 'No se pudo guardar el usuario.'];

        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Actualiza el perfil de un usuario.
     */
    public function actualizarPerfil($userId, $data, $image = null)
    {
        try {
            $updateData = [
                'usuario'  => $data['usuario'],
                'nombre'   => $data['nombre'],
                'apellido' => $data['apellido'],
                'email'    => $data['email'],
            ];

            if ($image && $image->isValid() && !$image->hasMoved()) {
                // Borrar imagen anterior si existe
                $user_actual = $this->usuarioModel->find($userId);
                if ($user_actual && !empty($user_actual['imagen'])) {
                    $old_path = FCPATH . 'assets/uploads/perfil/' . $user_actual['imagen'];
                    if (file_exists($old_path)) @unlink($old_path);
                }

                $nombre_imagen = $image->getRandomName();
                $image->move(FCPATH . 'assets/uploads/perfil', $nombre_imagen);
                $updateData['imagen'] = $nombre_imagen;
            }

            if (!$this->usuarioModel->update($userId, $updateData)) {
                return ['status' => 'error', 'message' => 'No se pudieron actualizar los datos.'];
            }

            return ['status' => 'success', 'message' => 'Perfil actualizado correctamente.', 'updated_data' => $updateData];

        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Cambia el rol de un usuario (Admin <-> Cliente).
     */
    public function cambiarPerfil($id)
    {
        $usuario = $this->usuarioModel->find($id);
        if (!$usuario) return false;

        $nuevo_perfil = ($usuario['perfil_id'] == 1) ? 2 : 1;
        return $this->usuarioModel->update($id, ['perfil_id' => $nuevo_perfil]);
    }

    /**
     * Da de baja (soft delete) a un usuario.
     */
    public function darDeBaja($id)
    {
        return $this->usuarioModel->update($id, ['baja' => 'SI']);
    }

    /**
     * Reactiva a un usuario dado de baja.
     */
    public function reactivar($id)
    {
        return $this->usuarioModel->update($id, ['baja' => 'NO']);
    }

    /**
     * Busca un usuario por ID.
     */
    public function getUsuario($id)
    {
        return $this->usuarioModel->find($id);
    }
}
