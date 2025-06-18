<?php

namespace App\Controllers;
use App\Models\Productos_Model;
use CodeIgniter\Controller;

/**
 * Controlador Pages
 * 
 * Controla la visualización de páginas estáticas del sitio web.
 */
class Pages extends BaseController
{
    /**
     * Muestra la página "Quiénes Somos".
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function quienesSomos()
    {
        return view('front/main', [
            'title' => 'CVA quienes somos',
            'content' => view('front/pages/quienesSomos')
        ]);
    }

    /**
     * Muestra la página de Comercialización.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function comercializacion()
    {   
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/comercializacion')
        ]);
    }

    /**
     * Muestra la página de Información de Contacto.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function informacionContacto()
    {
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/informacionContacto')
        ]);
    }

    /**
     * Muestra la página de Términos y Condiciones.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function terminosYCondiciones()
    {
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/terminosYCondiciones')
        ]);
    }

    /**
     * Muestra la página de Productos.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function productos()
    {
        $productoModel = new Productos_Model();
        $data['producto'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();

        return view('front/main', [
            'title' => 'Producto',
            'content' => view('front/pages/productos', $data)
        ]);
    }
}
