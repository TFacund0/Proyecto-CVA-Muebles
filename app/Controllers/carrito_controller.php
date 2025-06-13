<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Productos_model;
use App\Models\Usuario_model;
use App\Models\Categorias_model;


class carrito_controller extends BaseController
{
    public function __construct()
    {
        helper(['form','url','cart']);
        $cart = \Config\Services::cart();
        $session = session();
    }

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

    public function eliminar_item($rowid)
    {
        $cart = \Config\Services::Cart();
        $cart->remove($rowid);
        return redirect()->to(base_url("muestro"));
    }

    public function borrar_carrito()
    {
        $cart = \Config\Services::Cart();
        $cart->destroy();
        return redirect()->to(base_url("muestro"));
    }

    public function catalogo()
    {
        $productoModel = new Productos_Model();
        $data['producto'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();

        return view('front/main', [
            'title' => 'confirmar compra',
            'content' => view('front/pages/productos', $data)
        ]);
    }

    public function muestra() //carrito que se muestra
    {
        $perfil = session()->get('perfil_id');

        if ($perfil != 1) {
            return redirect()->to('/login');
        }
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        $data['cart'] = $cart;

        return view('front/main', [
            'title' => 'confirmar compra',
            'content' => view('front/pages/Carrito_parte_view', $data)
        ]);
    }

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

    public function devolver_carrito()
    {
        $cart = \Config\Services::cart();
        return $cart->contents();
    }

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