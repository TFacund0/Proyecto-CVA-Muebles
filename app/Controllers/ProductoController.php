<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

/**
 * Controlador para gestión de productos refactorizado para usar Capa de Servicios.
 */
class ProductoController extends BaseController {

    protected $productoService;
    protected $categoriaService;

    public function __construct() {
        helper(['form', 'url', 'text']);
        $this->productoService = new \App\Services\ProductoService();
        $this->categoriaService = new \App\Services\CategoriaService();
    }

    /**
     * Muestra el listado de productos para administración.
     */
    public function index() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $resultado = $this->productoService->getProductosConStats();
        
        return view('back/products/crud_productos', [
            'productos' => $resultado['productos'],
            'counts'    => $resultado['counts'],
            'categorias' => $this->categoriaService->getCategoriasConStats(),
            'vista'     => $this->request->getVar('vista') ?? 'NO',
            'title'     => 'Gestión de Productos'
        ]);
    }

    /**
     * Muestra el formulario de alta de producto.
     */
    public function create_alta_producto() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        return view('back/products/alta_producto', [
            'categorias' => $this->categoriaService->getCategoriasConStats(),
            'title' => 'Alta de Producto'
        ]);
    }

    /**
     * Valida y crea un producto delegando al servicio.
     */
    public function formValidation() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $rules = [
            'nombre_producto' => 'required|min_length[2]',
            'categoria_id'    => 'is_not_unique[categorias.id_categoria]',
            'precio'          => 'required|numeric',
            'precio-vta'      => 'required|numeric',
            'stock'           => 'required|integer',
            'stock-min'       => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashData('fail', 'No se cumple con todos los requisitos de los campos');
            return $this->create_alta_producto();
        }

        $resultado = $this->productoService->crearProducto([
            'nombre_prod'  => $this->request->getVar('nombre_producto'),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio'       => $this->request->getVar('precio'),
            'precio_vta'   => $this->request->getVar('precio-vta'),
            'stock'        => $this->request->getVar('stock'),
            'stock_min'    => $this->request->getVar('stock-min'),
            'descripcion'  => $this->request->getVar('descripcion'),
            'eliminado'    => $this->request->getVar('eliminado') ?? 'NO'
        ], $this->request->getFile('image'));

        if ($resultado['status'] === 'success') {
            return redirect()->to('/alta-producto')->with('success', $resultado['message']);
        } else {
            return redirect()->back()->withInput()->with('fail', $resultado['message']);
        }
    }

    /**
     * Muestra el formulario de edición de producto.
     */
    public function index_editar_producto($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $producto = $this->productoService->getProductoConGaleria($id);
        if (!$producto) return redirect()->to('/crud-productos')->with('fail', 'Producto no encontrado');

        return view('back/products/editar_producto', [
            'producto'   => $producto,
            'categorias' => $this->categoriaService->getCategoriasConStats(),
            'title'      => 'Editar Producto'
        ]);
    }

    /**
     * Actualiza un producto delegando al servicio.
     */
    public function modificar_producto($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        // Actualizar datos básicos e imagen principal
        $resultado = $this->productoService->actualizarProducto($id, [
            'nombre_prod'  => $this->request->getVar('nombre_producto'),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio'       => $this->request->getVar('precio'),
            'precio_vta'   => $this->request->getVar('precio-vta'),
            'stock'        => $this->request->getVar('stock'),
            'stock_min'    => $this->request->getVar('stock-min'),
            'descripcion'  => $this->request->getVar('descripcion')
        ], $this->request->getFile('imagen'));

        // Procesar galería adicional si vienen archivos
        $galeria = $this->request->getFileMultiple('fotos_galeria');
        if ($galeria) {
            $this->productoService->subirImagenesGaleria($id, $galeria);
        }

        if ($resultado['status'] === 'success') {
            return redirect()->to('/crud-productos')->with('success', $resultado['message']);
        } else {
            return redirect()->back()->with('fail', $resultado['message']);
        }
    }

    /**
     * Elimina un producto delegando al servicio.
     */
    public function delete_producto($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->productoService->eliminar($id);
        return redirect()->to('/crud-productos?vista=' . ($this->request->getGet('vista') ?? 'NO'));
    }

    /**
     * Reactiva un producto delegando al servicio.
     */
    public function activar_producto($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->productoService->reactivar($id);
        return redirect()->to('/crud-productos?vista=' . ($this->request->getGet('vista') ?? 'SI'));
    }

    /**
     * Muestra el detalle del producto para el cliente.
     */
    public function ver_detalle($id) {
        $producto = $this->productoService->getProductoConGaleria($id);
        if (!$producto) return redirect()->to('/productos')->with('fail', 'Producto no encontrado');

        return view('front/pages/detalle_producto', [
            'producto' => $producto,
            'title'    => $producto['nombre_prod']
        ]);
    }

    /**
     * Sube fotos a la galería de un producto.
     */
    public function subir_fotos_galeria($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $files = $this->request->getFileMultiple('fotos_galeria');
        if ($this->productoService->subirImagenesGaleria($id, $files)) {
            return redirect()->back()->with('success', 'Galería actualizada.');
        }
        return redirect()->back()->with('fail', 'No se pudieron subir las imágenes.');
    }

    /**
     * Elimina una foto de la galería.
     */
    public function eliminar_foto_galeria($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        if ($this->productoService->eliminarImagenGaleria($id)) {
            return redirect()->back()->with('success', 'Imagen eliminada.');
        }
        return redirect()->back()->with('fail', 'No se pudo eliminar la imagen.');
    }

}
