<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Entities\UsuarioEntity;

class AuthController extends BaseController
{
    public function vistaIniciarSesion(){        
        return view("auth/login");
    }

    public function vistaCrearUsuario(){
        return view("auth/registro");
    }

    public function mensaje()
    {
        return view("auth/mensaje");
    }

    public function iniciarSesion()
    {        
        $POST = $this->request->getPost();
        $auth = new UsuarioEntity($POST);
        $alertas = $auth->validarLogin();

        if(empty($alertas)){
            $usuario = $auth->where("email", $auth->email);
            if(!empty($usuario)){
                if(password_verify($POST['password'], $usuario[0]->password)){
                    session()->set([
                        "id" => $usuario[0]->id,
                        "nombre" => $usuario[0]->nombre,
                        "autenticado" => true
                    ]);
                    return redirect()->to(base_url('/inicio'));
                }else{
                    $alertas["error"][] = "Password incorrecto";
                }
            }else{
                $alertas["error"][] = "El usuario no existe";
            }
        }

        return redirect()->to(base_url())->withInput()->with('errors', $alertas);
    } 

    public function crearUsuario(){
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

        return redirect()->to(base_url('registro'))->withInput()->with('errors', $alertas);
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
