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
        
        // Obtenemos todas las consultas (activas por defecto para el inbox principal)
        $consultas = $consultasModel->orderBy('fecha', 'DESC')->findAll();

        $currentMonth = date('m');
        $currentYear = date('Y');
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $nombreMes = $meses[(int)$currentMonth - 1];

        $counts = [
            'total'     => count($consultas),
            'mensuales' => 0,
            'activos'   => 0,
            'presupuestos' => 0
        ];

        foreach ($consultas as &$c) {
            $cDate = strtotime($c['fecha']);
            
            // Contabilizar consultas del mes actual
            if (date('m', $cDate) == $currentMonth && date('Y', $cDate) == $currentYear) {
                $counts['mensuales']++;
            }

            if ($c['activo'] == 'SI') $counts['activos']++;
            
            // Contabilizar si es solicitud de presupuesto
            if (stripos($c['asunto'], 'presupuesto') !== false) {
                $counts['presupuestos']++;
            }

            // Preparar cadena de búsqueda para JS
            $c['search_data'] = strtolower(esc($c['nombre'] . ' ' . $c['apellido'] . ' ' . $c['email'] . ' ' . $c['asunto']));
        }

        $data = [
            'consultas' => $consultas,
            'counts'    => $counts,
            'nombreMes' => $nombreMes,
            'title'     => 'Gestión de Consultas'
        ];

        return view('back/messages/lista_consultas', $data);
    }

    /**
     * Procesa el envío de una nueva consulta desde el formulario
     */
    public function cargarConsulta() {
        $throttler = \Config\Services::throttler();

        // Límite: 3 consultas cada 24 horas (86400 segundos)
        // Usamos la IP del usuario como identificador
        if ($throttler->check(md5($this->request->getIPAddress()), 3, 86400) === false) {
            return redirect()->back()->withInput()->with('error', 'Has alcanzado el límite máximo de 3 consultas por día. Por favor, intenta mañana.');
        }

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
        return $this->index();
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
