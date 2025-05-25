<?php

namespace App\Controllers;

Use App\Models\Productos_model;
Use App\Models\Usuario_model;
Use App\Models\Categorias_model;
use CodeIgniter\Controller;

class ProductoController extends BaseController {

    public function __construct() {
        helper(['url', 'form']);
        $session = session();
    }

    //mostrar los productos en lista
    public function index() {
        $productoModel = new Producto_model();
        $data['producto'] = $productoModel->getProductoAll(); //funcion en el modelo

        $dato['titulo'] = 'Crud_productos';
        
        return view('front/main', [
            'title' => 'Alta Producto',
            'content' => view('back/producto/productos_nuevos', $dato, $data)
        ]);
    }

    public function create_alta_producto() {
        $session = session();
        $perfil = $session->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/');
        }
        
        $categoriasModel = new Categorias_model();
        $data['categorias'] = $categoriasModel->getCategorias();

        return view('front/main', [
            'title' => 'Alta Producto',
            'content' => view('back/producto/alta_producto', $data)
        ]);
    }

    public function formValidation() {
        $rules = [
            'producto' => 'required|'
        ];
    }
}