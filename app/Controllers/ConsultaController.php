<?php

namespace App\Controllers;

/**
 * Controlador para consultas refactorizado para usar Capa de Servicios.
 */
class ConsultaController extends BaseController {

    protected $consultaService;

    public function __construct() {
        helper(['form', 'url']);
        $this->consultaService = new \App\Services\ConsultaService();
    }

    /**
     * Muestra el listado de consultas para administración.
     */
    public function index() {    
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');

        $resultado = $this->consultaService->getConsultasConStats();
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        return view('back/messages/lista_consultas', [
            'consultas' => $resultado['consultas'],
            'counts'    => $resultado['counts'],
            'nombreMes' => $meses[(int)date('m') - 1],
            'title'     => 'Gestión de Consultas'
        ]);
    }

    /**
     * Procesa el envío de una nueva consulta.
     */
    public function cargarConsulta() {
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5($this->request->getIPAddress()), 3, 86400) === false) {
            return redirect()->back()->withInput()->with('error', 'Límite de 3 consultas por día alcanzado.');
        }

        // Honeypot check
        if (!empty($this->request->getPost('honeypot'))) {
            return redirect()->to('/')->with('error', 'Bot detectado.');
        }

        $rules = [
            'nombre'      => 'required|min_length[3]',
            'apellido'    => 'required|min_length[3]',
            'email'       => 'required|valid_email',
            'descripcion' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor, revisa los datos ingresados.');
        }

        $this->consultaService->registrar($this->request->getPost());
        return redirect()->back()->with('success', 'Consulta enviada correctamente.');
    }



    /**
     * Desactiva una consulta delegando al servicio.
     */
    public function eliminarConsulta($id) {
        if (session()->get('perfil_id') != 1) return redirect()->to('/login');
        $this->consultaService->desactivar($id);
        return redirect()->to('/consultas')->with('success', 'Consulta desactivada correctamente.');
    }
}
