<?php 

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class UsuarioController extends BaseController {

    public function __construct() {
        helper(['form', 'url']);
    }

    public function index_registrar() {
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
            'pass' => 'required|min_length[3]|max_length[50]',
            'terms' => 'required'
        ];

        $messages = [
            'name' => [
                'required' => 'El nombre es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.',
                'max_length' => 'El nombre debe tener menos de 50 caracteres.'
            ],
            'surname' => [
                'required' => 'El apellido es obligatorio.',
                'min_length' => 'El apellido debe tener al menos 3 caracteres.',
                'max_length' => 'El apellido debe tener menos de 30 caracteres.'
            ],
            'user' => [
                'required' => 'El nombre de usuario es obligatorio.',
                'min_length' => 'El nombre de usuario debe tener al menos 3 caracteres.',
                'max_length' => 'El nombre de usuario debe tener menos de 20 caracteres.',
                'alpha_numeric' => 'El nombre de usuario puede contener únicamente números y letras',
                'is_unique' => 'El nombre de usuario ya existe'
            ],
            'email' => [
                'required' => 'El correo electrónico es obligatorio.',
                'min_length' => 'El correo electrónico debe tener al menos 3 caracteres.',
                'max_length' => 'El correo electrónico debe tener menos de 100 caracteres.',
                'valid_email' => 'El correo electrónico no es válido',
                'is_unique' => 'El correo electrónico ya existe'
            ],
            'pass' => [
                'required' => 'La contraseña es obligatoria.',
                'min_length' => 'La contraseña debe tener al menos 3 caracteres.',
                'max_length' => 'La constraseña debe tener menos de 50 caracteres.'
            ],
            'terms' => [
                'required' => 'Los terminos y condiciones deben ser aceptados'
                ]
        ];

        $input = $this->validate($rules, $messages);

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
    public function index (){
        $perfil = session()->get('perfil_id');
        
        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $usuarios = new Usuarios_model();
        $data['usuarios'] = $usuarios->getUsuariosAll();
        $data['select'] = $this->request->getVar('option') ?? 10;

        return view('front/main', [
            'title' => 'Crud Usuarios',
            'content' => view('back/usuario/crud_usuarios', $data),
        ]);
    }

    public function index_perfil() {
        $perfil = session()->get('perfil_id');

        if ($perfil !=2 && $perfil != 1) {
            return redirect()->to('/login');
        }

        return view('front/main', [
            'title' => 'Configuracion Perfil',
            'content' => view('back/usuario/perfil_config'),
        ]);
    }

    public function guardarCambios()
    {
        $usuarioModel = new Usuarios_Model();

        // Datos del formulario
        $username = $this->request->getPost('username');
        $nombre   = $this->request->getPost('name');
        $apellido = $this->request->getPost('surname');
        $email    = $this->request->getPost('email');

        // Buscar el usuario por username y email
        $usuario = $usuarioModel
            ->where('usuario', $username)
            ->where('email', $email)
            ->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado con ese nombre y correo.');
        }

        $userId = $usuario['id_usuario']; // Obtenemos el ID

        // Subida de imagen
        $image = $this->request->getFile('image');
        $nombre_imagen = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $nombre_imagen = $image->getRandomName();
            $image->move(ROOTPATH.'assets/uploads/perfil', $nombre_imagen);
        }

        // Preparar datos para guardar
        $data = [
            'username' => $username,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'imagen' => $nombre_imagen,
        ];

        if ($nombre_imagen !== null) {
            $data['imagen'] = $nombre_imagen;
        }

        // Actualizar en la base de datos
        $usuarioModel->update($userId, $data);
        session()->set('imagen', $nombre_imagen);

        return redirect()->to('/perfil')->with('success', 'Perfil actualizado correctamente');
    }
}