<?php
namespace App\Controllers;
use App\Models\Favoritos_model;
use CodeIgniter\Controller;

class FavoritosController extends BaseController {

    /**
     * Crea la tabla de favoritos si no existe (Utilidad de emergencia)
     */
    public function setupDb() {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE IF NOT EXISTS favoritos (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT(11) UNSIGNED NOT NULL,
            producto_id INT(11) UNSIGNED NOT NULL,
            fecha DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        try {
            $db->query($sql);
            return "Tabla 'favoritos' creada o ya existente. Ya puedes usar el sistema de favoritos.";
        } catch (\Exception $e) {
            return "Error al crear la tabla: " . $e->getMessage();
        }
    }

    public function toggleFavorito($id_producto) {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Debes iniciar sesión']);
        }

        $usuario_id = session()->get('id_usuario');
        $model = new Favoritos_model();

        $existente = $model->where(['usuario_id' => $usuario_id, 'producto_id' => $id_producto])->first();

        if ($existente) {
            $model->delete($existente['id']);
            return $this->response->setJSON(['status' => 'removed', 'message' => 'Eliminado de favoritos']);
        } else {
            $model->insert([
                'usuario_id' => $usuario_id,
                'producto_id' => $id_producto,
                'fecha' => date('Y-m-d H:i:s')
            ]);
            return $this->response->setJSON(['status' => 'added', 'message' => 'Agregado a favoritos']);
        }
    }

    public function misFavoritos() {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $usuario_id = session()->get('id_usuario');
        $model = new Favoritos_model();
        
        $data['favoritos'] = $model->getFavoritosByUser($usuario_id);
        $data['title'] = 'Mis Favoritos - CVA Muebles';

        return view('front/pages/mis_favoritos', $data);
    }
}
