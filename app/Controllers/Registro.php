<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Registro extends Controller
{
    public function index()
    {
        return view('/front/paginas/registro');
    }

    /*public function guardar()
    {
        // Aquí iría la lógica para guardar los datos en la base de datos
        // ...

        return redirect()->to('/'); // Redirige a la página principal después del registro
    }*/
}