<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Productos_model;
use App\Models\Usuario_model;
use App\Models\Categorias_model;

/**
 * Controlador para gestionar el carrito de compras
 */
class carrito_controller extends BaseController
{
    /**
     * Constructor - Inicializa helpers y servicios
     */
    public function __construct()
    {
        helper(['form','url','cart']);
        $cart = \Config\Services::cart();
        $session = session();
    }

    /**
     * Agrega un producto al carrito
     */
    public function add()
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $cart->insert([
        'id'     => $request->getPost('id_producto'),
        'qty'    => 1,
        'name'   => $request->getPost('nombre_prod'),
        'price'  => $request->getPost('precio_vta'),
        'imagen' => $request->getPost('imagen'),
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Actualiza un item en el carrito
     */
    public function actualiza_carrito()
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $cart->update([
        'id'     => $request->getPost('id_producto'),
        'qty'    => 1,
        'name'   => $request->getPost('nombre_prod'),
        'price'  => $request->getPost('precio_vta'),
        'image' => $request->getPost('imagen'),
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Elimina un item específico del carrito
     */
    public function eliminar_item($rowid)
    {
        $cart = \Config\Services::Cart();
        $cart->remove($rowid);
        return redirect()->to(base_url("muestro"));
    }

    /**
     * Vacía completamente el carrito
     */
    public function borrar_carrito()
    {
        $cart = \Config\Services::Cart();
        $cart->destroy();
        return redirect()->to(base_url("muestro"));
    }

    /**
     * Muestra el catálogo de productos
     */
    public function catalogo(){
        $productoModel = new Productos_Model();
        $categorias = new Categorias_model();

        $data['producto'] = $productoModel
                                ->select('productos.*, categorias.descripcion as categoria')
                                ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
                                ->orderBy('id_producto', 'DESC')
                                ->findAll();

        $data['categorias'] = $categorias->select('descripcion')->distinct()->findAll();

        return view('front/main', [
            'title' => 'Productos',
            'content' => view('front/pages/productos', $data)
        ]);
    }

    /**
     * Muestra el contenido actual del carrito
     */
    public function muestra() //carrito que se muestra
    {
        $perfil = session()->get('id_usuario');

        if ($perfil == NULL) {
            return redirect()->to('/login');
        }
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        $data['cart'] = $cart;

        return view('front/main', [
            'title' => 'Carrito de Compras',
            'content' => view('front/pages/Carrito_parte_view', $data)
        ]);
    }

    /**
     * Elimina un item o vacía el carrito completo
     */
    public function remove($rowid)
    {

        $cart = \Config\Services::cart();

        if ($rowid == "all") {
            $cart->destroy(); // vacía el carrito
        } else {
            $cart->remove($rowid);
        }
        
        return redirect()->back()->withInput();
    }

    /**
     * Devuelve el contenido actual del carrito
     */
    public function devolver_carrito()
    {
        $cart = \Config\Services::cart();
        return $cart->contents();
    }

    /**
     * Incrementa la cantidad de un item en el carrito
     */
    public function suma($rowid)
    {
        $cart = \Config\Services::cart();
        $item = $cart->getItem($rowid);

        if ($item) {
            $cart->update([
                'rowid' => $rowid,
                'qty'   => $item['qty'] + 1
            ]);
        }
        return redirect()->to("muestro");
    }

    /**
     * Decrementa la cantidad de un item en el carrito
     */
    public function resta($rowid)
    {
        $cart = \Config\Services::cart();
        $item = $cart->getItem($rowid);

        if ($item) {
            if ($item['qty'] > 1) {
                $cart->update([
                    'rowid' => $rowid,
                    'qty'   => $item['qty'] - 1
                ]);
            } else {
                $cart->remove($rowid);
            }
            return redirect()->to("muestro");
        }
    }
}