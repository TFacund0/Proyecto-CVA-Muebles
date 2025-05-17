<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    public function index()
    {   
        // Renderiza la vista principal
        return view('front/main', [
            'title' => 'CVA Muebles',
            'content' => view('front/principal/plantilla')
        ]);
    }
}