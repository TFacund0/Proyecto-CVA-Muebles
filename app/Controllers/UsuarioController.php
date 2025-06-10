<?php 

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class UsuarioController extends BaseController {

    // Constructor donde se cargan helpers para formularios y URLs
    public function __construct() {
        helper(['form', 'url']);
    }

    // Muestra la vista para registrar un usuario, cargando la vista principal con contenido de registro
    public function index_registrar() {
        return view('front/main', [
            'title' => 'Registro',
            'content' => view('back/usuario/registro')
        ]);
    }

    // Método para validar el formulario de registro de usuario y guardar datos
    public function formValidation() {
        // Reglas de validación para cada campo del formulario
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'surname' => 'required|min_length[3]|max_length[30]',
            'user' => 'required|min_length[3]|max_length[20]|alpha_numeric|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[3]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[50]',
            'terms' => 'required'
        ];

        // Mensajes personalizados para cada regla de validación
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

        // Validar los datos recibidos del formulario según las reglas y mensajes
        $input = $this->validate($rules, $messages);

        $formModel = new Usuarios_model();

        // Si la validación falla
        if (!$input) {
            // Guardar un mensaje flash indicando el fallo
            session()->setFlashData('fail', 'No se cumple con todos los requerimientos de los campos');

            // Volver a cargar la vista de registro con el mensaje de error
            return view('front/main', [
                'title' => 'Registro',
                'content' => view('back/usuario/registro')
            ]);
        } else {
            // Si la validación pasa, guardar el usuario en la base de datos
            $formModel->save([
                'nombre' => $this->request->getVar('name'),
                'apellido' => $this->request->getVar('surname'),
                'usuario' => $this->request->getVar('user'),
                'email' => $this->request->getVar('email'),
                // Guardar la contraseña hasheada
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);

            // Guardar mensaje de éxito y redirigir al login
            session()->setFlashData('success', 'Usuario Registrado con Éxito! Por favor Inicie Sesión');
            return $this->response->redirect(base_url('/login'));
        }
    }

    // Método para mostrar el listado de usuarios (solo si el perfil es administrador)
    public function index (){
        $perfil = session()->get('perfil_id');
        
        // Si el perfil no es administrador (id = 1), redirigir al login
        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $usuarios = new Usuarios_model();
        // Obtener todos los usuarios
        $data['usuarios'] = $usuarios->getUsuariosAll();
        // Obtener el valor del selector o asignar 10 por defecto
        $data['select'] = $this->request->getVar('option') ?? 10;

        // Cargar la vista principal con la lista de usuarios
        return view('front/main', [
            'title' => 'Crud Usuarios',
            'content' => view('back/usuario/crud_usuarios', $data),
        ]);
    }

    // Mostrar la configuración del perfil, accesible para perfil 1 y 2
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

    // Método para guardar los cambios en el perfil del usuario
    public function guardarCambios()
    {
        $usuarioModel = new Usuarios_Model();

        // Obtener datos del formulario enviados por POST
        $username = $this->request->getVar('username');
        $nombre   = $this->request->getVar('name');
        $apellido = $this->request->getVar('surname');
        $email    = $this->request->getVar('email');

        // Manejar subida de imagen
        $image = $this->request->getFile('image');
        $nombre_imagen = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Generar nombre aleatorio para la imagen y moverla a la carpeta uploads/perfil
            $nombre_imagen = $image->getRandomName();
            $image->move(ROOTPATH.'assets/uploads/perfil', $nombre_imagen);
        }

        // Obtener el usuario actual de la sesión
        $session = session();
        $nombre_usuario = $session->get('usuario');
        $correo = $session->get('email');

        // Buscar usuario en la base de datos por usuario y correo
        $usuario = $usuarioModel
            ->where('usuario', $nombre_usuario)
            ->where('email', $correo)
            ->first();

        // Si no se encuentra el usuario, redirigir con mensaje de error
        if (!$usuario) {
            return redirect()->back()->with('fail', 'Usuario no encontrado con ese nombre y correo.');
        }

        // Obtener el id del usuario
        $userId = $usuario['id_usuario'];

        // Preparar los datos a actualizar
        $data = [
            'usuario' => $username,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
        ];

        // Si se subió una imagen, agregarla a los datos a guardar
        if ($nombre_imagen != null) {
            $data['imagen'] = $nombre_imagen;
        }

        // Actualizar el usuario en la base de datos
        $usuarioModel->update($userId, $data);

        // Actualizar datos de sesión
        session()->set($data);

        // Redirigir a la página de perfil con mensaje de éxito
        return redirect()->to('/perfil')->with('success', 'Perfil actualizado correctamente');
    }
}
