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

        $footerData = [
        'company_name'   => 'CVA Muebles',
        'company_address'=> '9 de Julio 1449, Ctes, Argentina',
        'phone'         => '+54 9 3794 098511',
        'social_links'  => [
            'facebook'  => 'https://fb.com/misitio',
            'twitter'   => 'https://twitter.com/misitio',
            'instagram' => 'https://instagram.com/misitio',
        ],
        'current_year'  => date('Y') // Usa el helper 'date'
        ];

        // 2. Construye la vista final ensamblando todo
        return view('front/navbar')
            . view('plantilla', ['title' => 'CVA Muebles'])
            . view('front/footer', $footerData);
    }

    public function quienesSomos()
    {
        return view('/front/paginas/quienesSomos');
    }
}