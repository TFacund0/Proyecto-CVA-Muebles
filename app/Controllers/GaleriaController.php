<?php
namespace App\Controllers;
use App\Models\GaleriaClientes_model;
use CodeIgniter\Controller;

class GaleriaController extends BaseController {

    public function index() {
        $model = new GaleriaClientes_model();
        $data['fotos'] = $model->getActivas();
        $data['title'] = 'CVA en tu Hogar - Galería de Clientes';
        
        return view('front/pages/galeria_clientes', $data);
    }

    public function subir() {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $img = $this->request->getFile('imagen');
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'assets/uploads/galeria', $newName);

            $model = new GaleriaClientes_model();
            $model->insert([
                'usuario_id' => session()->get('id_usuario'),
                'imagen' => $newName,
                'comentario' => $this->request->getPost('comentario'),
                'fecha' => date('Y-m-d H:i:s'),
                'activo' => 'NO' // El admin debe aprobarla
            ]);

            return redirect()->back()->with('success', '¡Gracias! Tu foto ha sido enviada y será publicada tras ser revisada.');
        }

        return redirect()->back()->with('error', 'Hubo un problema al subir la imagen.');
    }

    public function admin_index() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $model = new GaleriaClientes_model();
        $data['fotos'] = $model->select('galeria_clientes.*, usuarios.nombre')
                              ->join('usuarios', 'usuarios.id_usuario = galeria_clientes.usuario_id')
                              ->orderBy('activo', 'ASC')
                              ->orderBy('fecha', 'DESC')
                              ->findAll();
        
        $data['title'] = 'Moderación de Galería';
        return view('back/gallery/gestion_galeria', $data);
    }

    public function aprobar($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $model = new GaleriaClientes_model();
        $model->update($id, ['activo' => 'SI']);

        return redirect()->back()->with('success', 'Foto aprobada y publicada en la galería.');
    }

    public function eliminar($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $model = new GaleriaClientes_model();
        $model->delete($id);

        return redirect()->back()->with('success', 'La foto ha sido eliminada.');
    }

    public function setupDb() {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE IF NOT EXISTS galeria_clientes (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT(11) UNSIGNED NOT NULL,
            imagen VARCHAR(255) NOT NULL,
            comentario TEXT,
            fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
            activo ENUM('SI', 'NO') DEFAULT 'NO'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        try {
            $db->query($sql);
            return "Tabla 'galeria_clientes' creada exitosamente.";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
