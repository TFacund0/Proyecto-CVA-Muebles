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
            'name' => 'required|min_length[3]',
            'surname' => 'required|min_length[3]',
            'user' => 'required|min_length[3]',
            'email' => 'required|min_length[3]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[10]'
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
            session()->setFlashData('success', 'Usuario registrado con exito');
            return $this->response->redirect(base_url('/'));
        }
    }
}