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
            'nombre_producto' => 'required|min_length[3]|max_length[100]',
            'precio' => 'required|numeric',
            'precio-vta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock-min' => 'required|numeric'
        ];

        $messages = [
            'nombre_producto' => [
                'required' => 'El nombre del producto es obligatorio',
                'min_length' => 'La cantidad mínima de caracteres es 3',
                'max_length' => 'La cantidad máxima es de 100 caracteres'
            ],
            
            'precio' => [
                'required' => 'El precio del producto es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico',
            ],

            'precio-vta' => [
                'required' => 'El precio de venta del producto es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico',
            ],

            'stock' => [
                'required' => 'El stock del producto es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico',
            ],

            'stock-min' => [
                'required' => 'El stock minimo del producto es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico',
            ]
        ];

        $input = $this->validate($rules, $messages);

        $formProducto = new Productos_model();

        if (!$input) {
            session()->setFlashData('fail', 'No se cumple con todos los requisitos de los campos');

            return $this->create_alta_producto();
        } 
        else {
            $formProducto->save([
                'nombre_prod' => $this->request->getVar('nombre_producto'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min')
            ]);

            session()->setFlashData('success', 'El producto se ingreso con exito');
            return redirect()->to('/alta-producto');
        }
    }
}