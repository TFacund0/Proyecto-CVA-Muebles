<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;

class LoginController extends BaseController {
    public function index(){
        helper(['form', 'url']);
    }

    public function create() {
        return view('front/main', [
            'title' => 'Login',
            'content' => view('back/usuario/login')
        ]);
    }

    public function auth() {
        $session = session();
        $model = new Usuarios_model();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');

        $data = $model->where('email', $email)->first();

        if($data) {
            $pass = $data['pass'];
            $baja = $data['baja'];

            if($baja == 'SI') {
                $session->setFlashdata('msg', 'usuario dado de baja');
                return redirect()->to('/');
            }
            
            $verify_pass = password_verify($password, $pass);
            
            if($verify_pass) {
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in' => TRUE
                ];

                $session->set($ses_data);

                session()->setFlashdata('msg', 'Bienvenido');
                return redirect()->to('/');

            }else{
                $session->setFlashdata('msg', 'Password Incorrecta');
                return redirect()->to('/login');
            }

        }else{
            $session->setFlashdata('msg', 'No ingreso un email o el mismo es incorrecto');
                return redirect()->to('/login');
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}