<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Consultas_model;

class ConsultaController extends BaseController {
    public function index() {
        // Cargar los helpers necesarios
        helper(['form', 'url']);

        $consultasModel = new Consultas_model();
        $data['consultas'] = $consultasModel->findAll();

        return view('front/main', [
            'title' => 'Consulta',
            'content' => view('back/consultas/lista_consultas', $data)
        ]);
    }

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

    public function listarConsultas(){
        $consultasModel = new Consultas_model();

        $search = $this->request->getGet('search');
        $filtroTipo = $this->request->getGet('filtro_tipo');
        $asunto = $this->request->getGet('asunto');

        if ($filtroTipo == 'nombre_apellido' && !empty($search)) {
            $consultasModel->groupStart()
                ->like('nombre', $search)
                ->orLike('apellido', $search)
                ->groupEnd();
        }

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

    public function eliminarConsulta($id)
    {
        $consultasModel = new Consultas_model();
        $consultasModel->delete($id);

        return redirect()->to('/consultas')->with('success', 'Consulta eliminada correctamente.');
    }
}
