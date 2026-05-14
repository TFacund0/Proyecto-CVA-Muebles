<?php

namespace App\Controllers;

/**
 * Controlador para favoritos refactorizado para usar Capa de Servicios.
 */
class FavoritosController extends BaseController {

    protected $favoritosService;

    public function __construct() {
        $this->favoritosService = new \App\Services\FavoritosService();
    }

    /**
     * Alterna el estado de favorito de un producto (AJAX).
     */
    public function toggleFavorito($id_producto) {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Debes iniciar sesión']);
        }

        $resultado = $this->favoritosService->toggle(session()->get('id_usuario'), $id_producto);
        return $this->response->setJSON($resultado);
    }

    /**
     * Muestra la lista de favoritos del usuario.
     */
    public function misFavoritos() {
        if (!session()->get('logged_in')) return redirect()->to('/login');

        return view('front/pages/mis_favoritos', [
            'favoritos' => $this->favoritosService->getFavoritosConDetalle(session()->get('id_usuario')),
            'title'     => 'Mis Favoritos - CVA Muebles'
        ]);
    }

    }
}
