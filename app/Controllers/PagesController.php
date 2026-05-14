<?php

namespace App\Controllers;

/**
 * Controlador para páginas informativas y catálogo público.
 */
class PagesController extends BaseController
{
    protected $productoService;
    protected $favoritosService;
    protected $categoriaService;

    public function __construct() {
        $this->productoService = new \App\Services\ProductoService();
        $this->favoritosService = new \App\Services\FavoritosService();
        $this->categoriaService = new \App\Services\CategoriaService();
    }

    public function quienesSomos() {
        return view('front/pages/quienesSomos', ['title' => 'Quiénes Somos - CVA Muebles']);
    }

    public function comercializacion() {   
        return view('front/pages/comercializacion', ['title' => 'Comercialización - CVA Muebles']);
    }

    public function informacionContacto() {
        return view('front/pages/informacionContacto', ['title' => 'Contacto - CVA Muebles']);
    }

    public function terminosYCondiciones() {
        return view('front/pages/terminosYCondiciones', ['title' => 'Términos y Condiciones - CVA Muebles']);
    }

    public function beneficios() {
        return view('front/pages/beneficios', ['title' => 'Programa de Fidelidad - CVA Muebles']);
    }

    /**
     * Muestra el catálogo de productos delegando al servicio.
     */
    public function productos() {
        $resultado = $this->productoService->getProductosConStats();
        return view('front/pages/productos', [
            'producto'   => $resultado['productos'],
            'categorias' => $this->categoriaService->getCategoriasConStats(),
            'user_favs'  => session()->get('logged_in') ? $this->favoritosService->getFavoritosIds(session()->get('id_usuario')) : [],
            'title'      => 'Nuestros Productos - CVA Muebles'
        ]);
    }
}
