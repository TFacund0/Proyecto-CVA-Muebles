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
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $productoModel = new Productos_model();
        
        $vista = $this->request->getVar('vista') ?? 'NO'; // 'NO' para activos, 'SI' para eliminados

        $data['productos'] = $productoModel->where('eliminado', $vista)->findAll(); //funcion en el modelo
        $data['select'] = $this->request->getVar('option') ?? 10;
        $data['vista'] = $vista;

        return view('front/main', [
            'title' => 'Crud productos',
            'content' => view('back/producto/crud_productos', $data),
        ]);
    }

    public function create_alta_producto() {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
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
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
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

            'image' => [
                'uploaded' => 'La imagen del producto es obligatoria',
                'is_image' => 'El archivo debe ser una imagen válida',
                'mime_in' => 'La imagen debe ser de tipo jpg, jpeg o png'
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

        if (!$input) {
            session()->setFlashData('fail', 'No se cumple con todos los requisitos de los campos');

            return $this->create_alta_producto();
        } else {
            //Esto obtiene el archivo subido, el get var solo se usa para campos de texto.
            $image = $this->request->getFile('image');

            $nombre_imagen = $image->getRandomName();
            $image->move(ROOTPATH.'assets/uploads', $nombre_imagen);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre_producto'),
                'imagen' => $image->getName(),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min')
            ];
            
            $formProducto = new Productos_model();
            $formProducto->insert($data);

            session()->setFlashData('success', 'El producto se ingreso con exito');
            return redirect()->to('/alta-producto');
        }
    }

    public function delete_producto($id) {
        $productoModel = new Productos_model();
        $data = ['eliminado' => 'SI'];
        $productoModel->update($id, $data);
        
        $vista = $this->request->getGet('vista') ?? 'NO'; // Obtiene ?vista=SI o NO

    // Redirige y mantiene la vista en el formulario principal
        return redirect()->to('/crud-productos?vista=' . $vista);
    }

    

    public function activar_producto($id) {
        $productoModel = new Productos_model();
        $data = ['eliminado' => 'NO'];
        $productoModel->update($id, $data);
        $productoModel->update($id, $data);

         $vista = $this->request->getGet('vista') ?? 'SI'; // Obtiene ?vista=SI o NO

    // Redirige y mantiene la vista en el formulario principal
        return redirect()->to('/crud-productos?vista=' . $vista);
    }
}