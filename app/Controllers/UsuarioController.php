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
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'surname' => 'required|min_length[3]|max_length[30]',
            'user' => 'required|min_length[3]|max_length[20]|alpha_numeric|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[3]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[50]'
        ]

        $messages = [
            'name' => [
                'required' => 'El nombre es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                'max_length' => 'El nombre no debe tener más de 50 caracteres.'
            ]
        ]

        $input = $this->validate([
            
        ]);

        $formModel = new Usuarios_model();

        if (!$input) {
            session()->setFlashData('fail', 'No se cumple con todos los requerimientos de los campos');
            return view('front/main', [
                'title' => 'Registro',
                'content' => view('back/usuario/registro')
            ]);
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('name'),
                'apellido' => $this->request->getVar('surname'),
                'usuario' => $this->request->getVar('user'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);

            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga
            session()->setFlashData('success', 'Usuario Registrado con Éxito! Por favor Inicie Sesión');
            return $this->response->redirect(base_url('/login'));
        }
    }
}