<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Consultas_model;

class ConsultaController extends BaseController {

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
}
