<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;

class AuthController extends BaseController
{
    public function login(){        
        $alertas = [];
        $auth = new UsuarioModel();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $post = $this->request->getPost();
            $auth = new UsuarioModel($post);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                $usuario = $auth->where("email", $auth->email);
                if(!empty($usuario)){
                    if(password_verify($post["password"], $usuario[0]->password)){
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
        $usuario = new UsuarioModel();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $post = $this->request->getPost();
            $usuario = new UsuarioModel($post);
            $alertas = $usuario->validar_cuenta();
            if(empty($alertas)){
                $existeUsuario = $usuario->where("email", $usuario->email);
                if(!empty($existeUsuario)){
                    $alertas["error"][] = "El usuario ya esta registrado";
                }else{
                    $post["password"] = password_hash($post["password"], PASSWORD_BCRYPT);
                    $usuario->insert($post);
                    return redirect()->to(base_url('/'));
                }
            }
        }
        return view("auth/registro", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }
}
