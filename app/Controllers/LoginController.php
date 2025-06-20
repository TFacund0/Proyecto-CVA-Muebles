<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;

/**
 * Controlador para la gestión de login de usuarios.
 */
class LoginController extends BaseController {
    
    /**
     * Carga los helpers necesarios para formularios y URLs.
     */
    public function index(){
        helper(['form', 'url']);
    }

    /**
     * Muestra la vista del formulario de login.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function create() {
        if (session()->get('logged_in')) {
            // Si el usuario ya está autenticado, redirige a la página principal
            return redirect()->to('/');
        }

        return view('front/main', [
            'title' => 'Login',
            'content' => view('back/usuario/login')
        ]);
    }

    /**
     * Autentica al usuario verificando email/usuario y contraseña.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function auth() {
        $session = session();
        $model = new Usuarios_model();

        // Obtiene el email o usuario y la contraseña desde el formulario
        $login = $this->request->getVar('email'); // puede ser email o usuario
        $password = $this->request->getVar('pass');

        // Busca en la base de datos el usuario por email o usuario
        $data = $model->where('email', $login)
                        ->orWhere('usuario', $login)
                        ->first();

        if($data) {
            $pass = $data['pass'];
            $baja = $data['baja'];

            // Verifica si el usuario está dado de baja
            if($baja == 'SI') {
                $session->setFlashdata('msg', 'usuario dado de baja');
                return redirect()->to('/');
            }
            
            // Verifica la contraseña usando password_verify
            $verify_pass = password_verify($password, $pass);
            
            if($verify_pass) {
                // Datos de sesión para usuario autenticado
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
                // Contraseña incorrecta
                session()->setFlashdata('fallo_login', 'Contraseña Incorrecta');
                return redirect()->to('/login');
            }
        }
        else{
            // Usuario o email no encontrado
            session()->setFlashdata('fallo_login', 'Email o nombre de usuario incorrectos');
            return redirect()->to('/login');
        }
    }

    /**
     * Destruye la sesión y realiza el logout del usuario.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout() {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
