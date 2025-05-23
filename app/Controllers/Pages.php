<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function quienesSomos()
    {
        return view('front/main', [
            'title' => 'CVA quienes somos',
            'content' => view('front/pages/quienesSomos')
        ]);
    }

    public function comercializacion()
    {   
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/comercializacion')
        ]);
    }
    public function informacionContacto()
    {
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/informacionContacto')
        ]);
    }
    public function terminosYCondiciones()
    {
        return view('front/main', [
            'title' => 'CVA contactanos',
            'content' => view('front/pages/terminosYCondiciones')
        ]);
    }
    public function productos()
    {
        return view('front/main', [
            'title' => 'CVA productos',
            'content' => view('front/pages/productos')
        ]);
    }
}
