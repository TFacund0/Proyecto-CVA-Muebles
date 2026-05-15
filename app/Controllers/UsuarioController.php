<?php 

namespace App\Controllers;

/**
 * Controlador para gestión de usuarios refactorizado para usar Capa de Servicios.
 */
class UsuarioController extends BaseController {

    protected $usuarioService;

    public function __construct() {
        helper(['form', 'url']);
        $this->usuarioService = new \App\Services\UsuarioService();
    }

    /**
     * Muestra la vista de registro.
     */
    public function index_registrar() {    
        if (session()->get('logged_in')) return redirect()->to('/');
        return view('back/users/registro', ['title' => 'Registro']);
    }

    /**
     * Valida y registra un nuevo usuario delegando al servicio.
     */
    public function formValidation() {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'surname' => 'required|min_length[3]|max_length[30]',
            'user' => 'required|min_length[3]|max_length[20]|alpha_numeric|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[3]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[8]|max_length[50]',
            'terms' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('fail', 'No se cumple con todos los requerimientos de los campos');
        }

        $resultado = $this->usuarioService->registrarUsuario($this->request->getPost());

        if ($resultado['status'] === 'success') {
            return redirect()->to('/login')->with('success', $resultado['message']);
        } else {
            return redirect()->back()->withInput()->with('fail', $resultado['message']);
        }
    }

    /**
     * Muestra el listado de usuarios para administración.
     */
    public function index() {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $resultado = $this->usuarioService->getUsuariosConStats();
        
        return view('back/users/crud_usuarios', [
            'usuarios' => $resultado['usuarios'],
            'counts'   => $resultado['counts'],
            'vista'    => $this->request->getVar('vista') ?? 'NO',
            'title'    => 'Gestión de Usuarios'
        ]);
    }

    /**
     * Muestra la configuración del perfil.
     */
    public function index_perfil() {
        if (!session()->get('logged_in')) return redirect()->to('/login');
        return view('back/users/perfil_config', ['title' => 'Configuración Perfil']);
    }

    /**
     * Guarda cambios en el perfil delegando al servicio.
     */
    public function guardarCambios() {
        $resultado = $this->usuarioService->actualizarPerfil(
            session()->get('id_usuario'),
            [
                'usuario'  => $this->request->getVar('username'),
                'nombre'   => $this->request->getVar('name'),
                'apellido' => $this->request->getVar('surname'),
                'email'    => $this->request->getVar('email'),
            ],
            $this->request->getFile('image')
        );

        if ($resultado['status'] === 'success') {
            session()->set($resultado['updated_data']);
            return redirect()->to('/perfil')->with('success', $resultado['message']);
        } else {
            return redirect()->back()->with('fail', $resultado['message']);
        }
    }

    /**
     * Da de baja a un usuario delegando al servicio.
     */
    public function delete_usuario($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->usuarioService->darDeBaja($id);
        return redirect()->to('/crud-usuarios?vista=' . ($this->request->getGet('vista') ?? 'NO'));
    }

    /**
     * Reactiva a un usuario delegando al servicio.
     */
    public function activar_usuario($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->usuarioService->reactivar($id);
        return redirect()->to('/crud-usuarios?vista=' . ($this->request->getGet('vista') ?? 'SI'));
    }

    /**
     * Cambia el perfil de un usuario delegando al servicio.
     */
    public function editar_usuario($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->usuarioService->cambiarPerfil($id);
        return redirect()->to('/crud-usuarios')->with('success', 'Modificación exitosa');
    }
}
