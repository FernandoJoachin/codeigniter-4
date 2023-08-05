<?php

namespace App\Controllers;

class InicioController extends BaseController
{
    public function index(){
        
        return view("pagina/inicio");
    }
}
