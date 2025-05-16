<?php 

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class UsuarioController extends BaseController {

    public function __construct() {
        helper(['form', 'url']);
    }

    public function create() {
        return view('front/main', [
            'title' => 'Registro',
            'content' => view('back/usuario/registro')
        ]);
    }

    public function formValidation() {
        $input = $this->validate([
            'name' => 'required | min_length[3]',
            'surname' => 'required | min_length[3]',
            'user' => 'required | min_length[3]',
            'email' => 'required | min_length[3] | max_length[25]',
            'pass' => 'required | min_length[3] | max_length[10]'
        ]);

        $formModel = new Usuarios_model();

        if (!$input) {
            return view('front/main', [
                'title' => 'Registro',
                'content' => view('back/usuario/registro', ['validation' => $this->validator])
            ]);
        } else {
            $formModel->save([
                'name' => $this->request->getVar('name'),
                'surname' => $this->request->getVar('surname'),
                'user' => $this->request->getVar('user'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);

            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga
            session()->setFlashData('success', 'Usuario registrado con exito');
            return $this->response->redirect(base_url('/registro'));
        }
    }
}