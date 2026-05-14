<?php

namespace App\Controllers;

/**
 * Controlador para la galería refactorizado para usar Capa de Servicios.
 */
class GaleriaController extends BaseController {

    protected $galeriaService;

    public function __construct() {
        $this->galeriaService = new \App\Services\GaleriaService();
    }

    public function index() {
        return view('front/pages/galeria_clientes', [
            'fotos' => $this->galeriaService->getAprobadas(),
            'title' => 'CVA en tu Hogar - Galería de Clientes'
        ]);
    }

    public function subir() {
        if (!session()->get('logged_in')) return redirect()->to('/login');

        $img = $this->request->getFile('imagen');
        $resultado = $this->galeriaService->subir(
            session()->get('id_usuario'),
            $img,
            $this->request->getPost('comentario')
        );

        if ($resultado) {
            return redirect()->back()->with('success', '¡Gracias! Tu foto ha sido enviada y será publicada tras ser revisada.');
        }

        return redirect()->back()->with('error', 'Hubo un problema al subir la imagen.');
    }

    public function admin_index() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        return view('back/gallery/gestion_galeria', [
            'fotos' => $this->galeriaService->getAllConUsuarios(),
            'title' => 'Moderación de Galería'
        ]);
    }

    public function aprobar($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->galeriaService->aprobar($id);
        return redirect()->back()->with('success', 'Foto aprobada y publicada.');
    }

    public function eliminar($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->galeriaService->eliminar($id);
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
            return "Tabla 'galeria_clientes' configurada.";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
