<?php

namespace App\Controllers;

use App\Entities\PersonaEntity;
use App\Models\PersonaModel;
use CodeIgniter\Files\File;


class PersonaController extends BaseController
{
    private $folderTmp = './files/tmp/';
    private $folder = './files/img/';

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
            $persona = new PersonaEntity($POST);
            $alertas = $persona->validar_persona();
            if(empty($alertas)){
                $personaModel = new PersonaModel();
                $nombreArchivos = $this->moveFile($POST["archivo"]);
                foreach($nombreArchivos as $nombreArchivo){
                    $data = [
                        "nombre" => $persona->nombre,
                        "folder" => "/public/files/img/",
                        "imagen" => $nombreArchivo
                    ];
                    $personaModel->insert($data);
                }
                return redirect()->to(base_url('/inicio/personas'));
            }else{
                foreach(glob($this->folderTmp . "/*") as $archivo){
                    unlink($archivo);
                }
            }
        }

        return view("pagina/personas/crear", [
            "alertas" => $alertas,
            "persona" => $persona
        ]);
    }

    public function process(){
        $file = $this->request->getFiles()["archivo"][0] ?? null;
        $key = md5(uniqid(rand(), true));
        
        if(!empty($file)){
            $file->move($this->folderTmp, $key . '.' .  $file->getExtension());
        }

        $archivos = session()->get('archivos') ?? [];
        $archivos[] = $key;
        session()->set('archivos', $archivos);
        return $key;
    }
    public function revert()
    {
        $data = $this->request->getBody();

        $this->deleteFile($this->folderTmp . $data);

        return $data;
    }

    private function deleteFile($path)
    {
        $files = glob($path . ".*");

        if ($files && file_exists($files[0])) {
            unlink($files[0]);
        }
    }

    private function moveFile($archivosFilepond){
        $archivos = $archivosFilepond;
        $archivosNombre = [];

        if(!is_dir($this->folder)){
            mkdir($this->folder);
        }

        foreach ($archivos as $key => $value) {
            $files = glob($this->folderTmp . $value . ".*");

            if($files){
                $file = new File($files[0]);
                unset($archivos[$key]);
                $filenombre = $file->getRandomName();
                $file->move($this->folder, $filenombre);
                $archivosNombre[] = $filenombre;
            }
        }
        return $archivosNombre;
    }
}
