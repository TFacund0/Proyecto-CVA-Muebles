<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        helper(['url', 'date']); // Carga los helpers
    }

    public function index()
    {
        // Datos para el footer
        $footerData = [
            'company_name'    => 'CVA Muebles',
            'company_address' => '9 de Julio 1449, Ctes, Argentina',
            'phone'           => '+54 9 3794 098511',
            'social_links'    => [
                'facebook'  => 'https://fb.com/misitio',
                'twitter'   => 'https://twitter.com/misitio',
                'instagram' => 'https://instagram.com/misitio',
            ],
            'current_year'    => date('Y') // Usa el helper 'date'
        ];

        // Renderiza la vista principal
        return view('front/principal/plantilla', [
            'title' => 'CVA Muebles',
            'footerData' => $footerData
        ]);
    }
    public function quienesSomos()
    {
        return view('front/pages/quienesSomos');
    }

    public function comercializacion()
    {
        return view('front/pages/comercializacion');
    }

    public function informacionContacto()
    {
        return view('front/pages/informacionContacto');
    }
    public function terminosYCondiciones()
    {
        return view('front/pages/terminosYCondiciones');
    }
}
