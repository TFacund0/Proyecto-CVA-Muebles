<?php

namespace App\Controllers;

/**
 * Controlador para login refactorizado para usar Capa de Servicios.
 */
class LoginController extends BaseController {
    
    protected $usuarioService;

    public function __construct() {
        $this->usuarioService = new \App\Services\UsuarioService();
    }

    /**
     * Muestra la vista del formulario de login.
     */
    public function create() {
        if (session()->get('logged_in')) return redirect()->to('/');
        return view('back/users/login', ['title' => 'Login']);
    }

    /**
     * Autentica al usuario delegando al servicio.
     */
    public function auth() {
        $resultado = $this->usuarioService->autenticar(
            $this->request->getVar('email'),
            $this->request->getVar('pass')
        );

        if($resultado['status'] === 'success') {
            session()->set($resultado['data']);
            return redirect()->to('/')->with('success', '¡Bienvenido de nuevo!');
        } else {
            return redirect()->back()->withInput()->with('error', $resultado['message']);
        }
    }

    /**
     * Destruye la sesión.
     */
    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }
}
