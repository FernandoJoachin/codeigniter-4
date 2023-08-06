<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;
use App\Entities\UsuarioEntity;

class AuthController extends BaseController
{
    public function login(){        
        $alertas = [];
        $auth = new UsuarioEntity();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $auth = new UsuarioEntity($POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                $usuario = $auth->where("email", $auth->email);
                if(!empty($usuario)){
                    $auth->password = $usuario[0]->password;
                    if($auth->comprobar_password($POST["password"])){
                        return redirect()->to(base_url('/inicio'));
                    }else{
                        $alertas["error"][] = "Password incorrecto";
                    }
                }else{
                    $alertas["error"][] = "El usuario no existe";
                }
            }
        }

        return view("auth/login", [
            "usuario" => $auth,
            "alertas" => $alertas
        ]);
    }


    public function crear(){
        $alertas = [];
        $usuario = new UsuarioEntity();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $usuario = new UsuarioEntity($POST);
            $alertas = $usuario->validar_cuenta();
            if(empty($alertas)){
                $existeUsuario = $usuario->where("email", $usuario->email);
                if(!empty($existeUsuario)){
                    $alertas["error"][] = "El usuario ya esta registrado";
                }else{
                    $usuarioModel = new UsuarioModel();
                    $usuario->password_encryptado();
                    $usuarioModel->insert($usuario);
                    return redirect()->to(base_url('/mensaje'));
                }
            }
        }
        return view("auth/registro", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public function mensaje(){
        return view("auth/mensaje");
    }
}
