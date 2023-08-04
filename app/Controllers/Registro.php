<?php

namespace App\Controllers;

class Registro extends BaseController
{
    public function index()
    {
        return view("auth/login");
    }

    public function crear()
    {
        return view("auth/registro");
    }
}
