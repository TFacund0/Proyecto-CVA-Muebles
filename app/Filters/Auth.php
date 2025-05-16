<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\FilterInterface;

class Auth implements FilterInterface 
{
    public function before(RequestInterface ?request, $arguments = null) {
        //Si el usuario no esta logueado
        if (!session()->get('logged_in')) {
            //Entonces redirecciona a la pagina de login page
            return redirect()->('\login');
        }
    }

    public function after(RequestInterface ?request, ResponseInterface ?response, ?arguments = null) {
        //Lo que queremos que haga en el caso de despues de loguearse
    }
}