<?php

namespace App\Controllers;
use App\Models\Productos_Model;
use App\Models\Categorias_Model;
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
        return view('front/pages/quienesSomos', [
            'title' => 'Quiénes Somos - CVA Muebles'
        ]);
    }

    /**
     * Muestra la página de Comercialización.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function comercializacion()
    {   
        return view('front/pages/comercializacion', [
            'title' => 'Comercialización - CVA Muebles'
        ]);
    }

    /**
     * Muestra la página de Información de Contacto.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function informacionContacto()
    {
        return view('front/pages/informacionContacto', [
            'title' => 'Contacto - CVA Muebles'
        ]);
    }

    /**
     * Muestra la página de Términos y Condiciones.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function terminosYCondiciones()
    {
        return view('front/pages/terminosYCondiciones', [
            'title' => 'Términos y Condiciones - CVA Muebles'
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
        $categorias = new Categorias_Model();
        $data['producto'] = $productoModel
                                ->select('productos.*, categorias.descripcion as categoria')
                                ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
                                ->orderBy('id_producto', 'DESC')
                                ->findAll();

        $data['categorias'] = $categorias->select('descripcion')->distinct()->findAll();
        $data['title'] = 'Nuestros Productos - CVA Muebles';

        return view('front/pages/productos', $data);
    }
}
