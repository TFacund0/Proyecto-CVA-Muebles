<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Consultas_model;

/**
 * Controlador para gestionar las consultas de usuarios
 */
class ConsultaController extends BaseController {

    /**
     * Muestra la vista principal de consultas (solo para administradores)
     */
    public function index() {    
        // Cargar los helpers necesarios
        helper(['form', 'url']);

        $perfil = session()->get('perfil_id');
        
        // Si el perfil no es administrador (id = 1), redirigir al login
        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $consultasModel = new Consultas_model();
        $data['consultas'] = $consultasModel->findAll();

        return view('front/main', [
            'title' => 'Consulta',
            'content' => view('back/consultas/lista_consultas', $data)
        ]);
    }

    /**
     * Procesa el envío de una nueva consulta desde el formulario
     */
    public function cargarConsulta() {
        $consultas = new Consultas_model();
        
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'asunto' => $this->request->getPost('asunto'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha' => date('Y-m-d')
        ];

        // Validar los datos antes de guardarlos
        if ($this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'descripcion' => 'required|min_length[10]',
        ])) {
            
            $consultas->insert($data);
            return redirect()->back()->with('success', 'Consulta enviada correctamente.');

        } else {
            // Redirigir con errores de validación
            return redirect()->back()->withInput()->with('error', 'Envio fallido. Por favor, revisa los datos ingresados.');
        }
    }

    /**
     * Lista las consultas con opciones de filtrado (solo para administradores)
     */
    public function listarConsultas() {
        $perfil = session()->get('perfil_id');
        
        // Si el perfil no es administrador (id = 1), redirigir al login
        if ($perfil != 1) {
            return redirect()->to('/login');
        }

        $consultasModel = new Consultas_model();

        $search = $this->request->getGet('search');
        $filtroTipo = $this->request->getGet('filtro_tipo');
        $asunto = $this->request->getGet('asunto');

        // Iniciar filtro por las activas
        $consultasModel->where('activo', 'SI');

        // Filtro por nombre o apellido
        if ($filtroTipo == 'nombre_apellido' && !empty($search)) {
            $consultasModel->groupStart()
                ->like('nombre', $search)
                ->orLike('apellido', $search)
                ->groupEnd();
        }

        // Filtro por asunto
        if ($filtroTipo == 'asunto' && !empty($asunto)) {
            $consultasModel->where('asunto', $asunto);
        }

        $data['consultas'] = $consultasModel
            ->orderBy('fecha', 'DESC')
            ->findAll();

        return view('front/main', [
            'title' => 'Consulta',
            'content' => view('back/consultas/lista_consultas', $data)
        ]);
    }

    /**
     * Desactiva una consulta (marcándola como inactiva en lugar de eliminarla)
     */
    public function eliminarConsulta($id) {
        $consultasModel = new Consultas_model();

        // Actualiza el campo 'activo' a 'NO' en lugar de eliminarlo
        $consultasModel->update($id, ['activo' => 'NO']);

        return redirect()->to('/consultas')->with('success', 'Consulta desactivada correctamente.');
    }

}