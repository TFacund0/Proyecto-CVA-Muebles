<?php

namespace App\Controllers;

use App\Models\Productos_model;
use App\Models\Usuario_model;
use App\Models\Categorias_model;
use CodeIgniter\Controller;

/**
 * Controlador para la gestión de productos
 * 
 * Permite:
 * - Listar productos (activos/eliminados)
 * - Crear nuevos productos
 * - Editar productos existentes  
 * - Eliminar/activar productos (soft delete)
 */
class ProductoController extends BaseController {

    /**
     * Constructor - Inicializa helpers y sesión
     */
    public function __construct() {
        helper(['url', 'form']);
        $session = session(); // Inicia la sesión
    }    

    /**
     * Muestra el listado de productos
     * @return View Vista de administración de productos
     */
    public function index() {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $productoModel = new Productos_model();
        $categoriaModel = new Categorias_model();

        $search = $this->request->getGet('search');
        $cat_id = $this->request->getGet('categoria_id');
        $vista = $this->request->getVar('vista') ?? 'NO';
        $limit = $this->request->getVar('option') ?? 10;

        $builder = $productoModel->select('productos.*, categorias.descripcion as categoria')
                                 ->join('categorias', 'categorias.id_categoria = productos.categoria_id')
                                 ->where('productos.eliminado', $vista);

        if (!empty($search)) {
            $builder->like('productos.nombre_prod', $search);
        }

        if (!empty($cat_id)) {
            $builder->where('productos.categoria_id', $cat_id);
        }

        $data = [
            'productos' => $builder->findAll(),
            'categorias' => $categoriaModel->findAll(),
            'select' => $limit,
            'vista' => $vista
        ];

        $data['title'] = 'Gestión de Productos';
        return view('back/products/crud_productos', $data);
    }

    /**
     * Muestra el formulario de alta de producto
     * @return View Vista del formulario de creación
     */
    public function create_alta_producto() {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $categoriasModel = new Categorias_model();
        $data['categorias'] = $categoriasModel->getCategorias();

        $data['title'] = 'Alta Producto';
        return view('back/products/alta_producto', $data);
    }

    /**
     * Valida y procesa el formulario de alta de producto
     * @return Redirect Redirección con mensaje de éxito/error
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
                'numeric' => 'El valor debe ser únicamente numérico'
            ],
            'precio-vta' => [
                'required' => 'El precio de venta es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico'
            ],
            'stock' => [
                'required' => 'El stock es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico'
            ],
            'stock-min' => [
                'required' => 'El stock mínimo es obligatorio',
                'numeric' => 'El valor debe ser únicamente numérico'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            session()->setFlashData('fail', 'No se cumple con todos los requisitos de los campos');
            return $this->create_alta_producto();
        }

        $image = $this->request->getFile('image');
        $nombre_imagen = $image->getRandomName();
        $image->move(ROOTPATH . 'assets/uploads', $nombre_imagen);

        $data = [
            'nombre_prod' => $this->request->getVar('nombre_producto'),
            'imagen' => $image->getName(),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio-vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock-min'),
            'descripcion' => $this->request->getVar('descripcion')
        ];

        $productoModel = new Productos_model();
        $productoModel->insert($data);

        session()->setFlashData('success', 'El producto se ingresó con éxito');
        return redirect()->to('/alta-producto');
    }

    /**
     * Marca un producto como eliminado (soft delete)
     * @param int $id ID del producto a eliminar
     * @return Redirect Redirección al listado
     */
    public function delete_producto($id) {
        $productoModel = new Productos_model();
        $productoModel->update($id, ['eliminado' => 'SI']);

        $vista = $this->request->getGet('vista') ?? 'NO';
        return redirect()->to('/crud-productos?vista=' . $vista);
    }

    /**
     * Reactiva un producto marcado como eliminado
     * @param int $id ID del producto a activar
     * @return Redirect Redirección al listado
     */
    public function activar_producto($id) {
        $productoModel = new Productos_model();
        $productoModel->update($id, ['eliminado' => 'NO']);

        $vista = $this->request->getGet('vista') ?? 'SI';
        return redirect()->to('/crud-productos?vista=' . $vista);
    }

    /**
     * Muestra el formulario de edición de producto
     * @param int $id ID del producto a editar
     * @return View Vista del formulario de edición
     */
    public function index_editar_producto($id) {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $productoModel = new Productos_model();
        $categoriasModel = new Categorias_model();

        $data = [
            'producto' => $productoModel->find($id),
            'categorias' => $categoriasModel->getCategorias()
        ];

        $data['title'] = 'Editar Producto';
        return view('back/products/editar_producto', $data);
    }

    /**
     * Procesa la actualización de un producto
     * @param int $id ID del producto a modificar
     * @return Redirect Redirección con mensaje de éxito
     */
    public function modificar_producto($id) {
        $productoModel = new Productos_model();
        $img = $this->request->getFile('imagen');

        if ($img && $img->isValid()) {
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

            $data = [
                'imagen' => $img->getName(),
                'nombre_prod' => $this->request->getVar('nombre_producto'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
                'descripcion' => $this->request->getVar('descripcion')
            ];
        } else {
            $data = [
                'nombre_prod' => $this->request->getVar('nombre_producto'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio-vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock-min'),
                'descripcion' => $this->request->getVar('descripcion')
            ];
        }

        $productoModel->update($id, $data);
        session()->setFlashdata('success', 'Modificación exitosa');
        return redirect()->to('/crud-productos');
    }

    /**
     * @brief Muestra la ficha de detalle de un producto específico (Estilo Mercado Libre)
     * @param int $id ID del producto
     * @return View Vista de detalle
     */
    public function ver_detalle($id) {
        $productoModel = new Productos_model();
        $data['producto'] = $productoModel->getProducto($id);

        if (!$data['producto']) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado');
        }

        $data['title'] = 'Detalle de ' . $data['producto']['nombre_prod'];
        return view('front/pages/detalle_producto', $data);
    }
}
