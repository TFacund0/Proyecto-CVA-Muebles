<?php

namespace App\Services;

use App\Models\ProductoModel;

/**
 * Servicio para manejar la lógica de negocio relacionada con los productos.
 */
class ProductoService
{
    protected $productoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    /**
     * Obtiene el listado de productos con estadísticas para el panel.
     */
    public function getProductosConStats()
    {
        $productos = $this->productoModel->getProductoAll();

        $counts = [
            'total' => count($productos),
            'activos' => 0,
            'sin_stock' => 0,
            'eliminados' => 0
        ];

        foreach ($productos as $p) {
            if ($p['eliminado'] == 'NO') {
                $counts['activos']++;
                if ($p['stock'] <= 0) $counts['sin_stock']++;
            } else {
                $counts['eliminados']++;
            }
        }

        return [
            'productos' => $productos,
            'counts' => $counts
        ];
    }

    /**
     * Crea un nuevo producto.
     */
    public function crearProducto($data, $image = null)
    {
        try {
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $nombre_imagen = $image->getRandomName();
                $image->move(ROOTPATH . 'assets/uploads', $nombre_imagen);
                $data['imagen'] = $nombre_imagen;
            }

            return $this->productoModel->insert($data)
                ? ['status' => 'success', 'message' => 'Producto creado con éxito.']
                : ['status' => 'error', 'message' => 'No se pudo guardar el producto.'];

        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Actualiza un producto existente.
     */
    public function actualizarProducto($id, $data, $image = null)
    {
        try {
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $nombre_imagen = $image->getRandomName();
                $image->move(ROOTPATH . 'assets/uploads', $nombre_imagen);
                $data['imagen'] = $nombre_imagen;
            }

            return $this->productoModel->update($id, $data)
                ? ['status' => 'success', 'message' => 'Producto actualizado con éxito.']
                : ['status' => 'error', 'message' => 'No se pudo actualizar el producto.'];

        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Marca un producto como eliminado (soft delete).
     */
    public function eliminar($id)
    {
        return $this->productoModel->update($id, ['eliminado' => 'SI']);
    }

    /**
     * Reactiva un producto eliminado.
     */
    public function reactivar($id)
    {
        return $this->productoModel->update($id, ['eliminado' => 'NO']);
    }

    /**
     * Obtiene un producto por ID.
     */
    public function getProducto($id)
    {
        return $this->productoModel->getProducto($id);
    }
}
