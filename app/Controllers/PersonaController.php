<?php

namespace App\Controllers;

use App\Entities\PersonaEntity;
use App\Models\PersonaModel;
use CodeIgniter\Files\File;


class PersonaController extends BaseController
{
    public function index(){
        $personaModel = new PersonaModel();
        $personas = $personaModel->findAll();
        return view("pagina/personas/inicio",[
            "personas" => $personas
        ]);
    }

    public function crear(){
        $alertas = [];
        $persona = new PersonaEntity();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $images = $POST["archivo"];
        }

        return view("pagina/personas/crear", [
            "alertas" => $alertas,
            "persona" => $persona
        ]);
    }

    public function process(){
        $file = $this->request->getFiles();
        dd($file);
    }
}
