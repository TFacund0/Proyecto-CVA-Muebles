<?php

namespace App\Controllers;

Use App\Models\Productos_model;
Use App\Models\Usuario_model;
Use App\Models\Categorias_model;
use CodeIgniter\Controller;

class ProductoController extends BaseController {
    // Constructor que carga los helpers de URL y formularios, y crea la sesión
    public function __construct() {
        helper(['url', 'form']);
        $session = session();
    }

    /**
     * Muestra la lista de productos, filtrando por estado (activos o eliminados)
     * Solo permite el acceso si el usuario tiene perfil_id = 1 (administrador)
     * La variable 'vista' indica si se muestran productos eliminados ('SI') o activos ('NO')
     */
    public function index() {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $productoModel = new Productos_model();
        
        // Obtiene el parámetro 'vista' para filtrar productos eliminados o no
        $vista = $this->request->getVar('vista') ?? 'NO'; // 'NO' para activos, 'SI' para eliminados

        // Obtiene los productos según el filtro 'eliminado'
        $data['productos'] = $productoModel->where('eliminado', $vista)->findAll();
        $data['select'] = $this->request->getVar('option') ?? 10; // Cantidad a mostrar
        $data['vista'] = $vista;

        // Carga la vista principal con el listado de productos
        return view('front/main', [
            'title' => 'Crud productos',
            'content' => view('back/producto/crud_productos', $data),
        ]);
    }

    /**
     * Muestra el formulario para dar de alta un nuevo producto
     * Solo accesible para usuarios con perfil_id = 1
     * Obtiene la lista de categorías para el selector en el formulario
     */
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

    /**
     * Valida el formulario de creación de producto y guarda el producto en la base de datos
     * Reglas de validación para campos obligatorios, formatos y tipo de archivo imagen
     * En caso de error vuelve a mostrar el formulario, si es correcto guarda y redirige
     */
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

        // Valida los datos recibidos con las reglas y mensajes definidos
        $input = $this->validate($rules, $messages);

        if (!$input) {
            // Si no valida, genera mensaje de error y muestra el formulario nuevamente
            session()->setFlashData('fail', 'No se cumple con todos los requisitos de los campos');

            return $this->create_alta_producto();
        } else {
            // Si valida, obtiene la imagen subida y la mueve a la carpeta correspondiente
            $image = $this->request->getFile('image');

            $nombre_imagen = $image->getRandomName();
            $image->move(ROOTPATH.'assets/uploads', $nombre_imagen);

            // Prepara datos para insertar en la tabla productos
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

            // Mensaje de éxito y redirecciona a alta producto
            session()->setFlashData('success', 'El producto se ingreso con exito');
            return redirect()->to('/alta-producto');
        }
    }

    /**
     * Marca un producto como eliminado (sin borrarlo físicamente)
     * Cambia el campo 'eliminado' a 'SI' para el producto con el ID dado
     * Mantiene la vista activa o eliminada tras la actualización
     */
    public function delete_producto($id) {
        $productoModel = new Productos_model();
        $data = ['eliminado' => 'SI'];
        $productoModel->update($id, $data);
        
        // Obtiene la vista actual para redireccionar correctamente
        $vista = $this->request->getGet('vista') ?? 'NO'; // Obtiene ?vista=SI o NO

        // Redirige a la lista de productos manteniendo el filtro de vista
        return redirect()->to('/crud-productos?vista=' . $vista);
    }

    /**
     * Reactiva un producto eliminado, cambiando el campo 'eliminado' a 'NO'
     * Mantiene la vista activa o eliminada tras la actualización
     */
    public function activar_producto($id) {
        $productoModel = new Productos_model();
        $data = ['eliminado' => 'NO'];

        $productoModel->update($id, $data);

        // Obtiene la vista actual para redireccionar correctamente
        $vista = $this->request->getGet('vista') ?? 'SI'; // Obtiene ?vista=SI o NO

        // Redirige a la lista de productos manteniendo el filtro de vista
        return redirect()->to('/crud-productos?vista=' . $vista);
    }
}
