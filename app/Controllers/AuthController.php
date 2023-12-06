<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;
use App\Entities\UsuarioEntity;

/**
 * Controlador para la autenticación de usuarios.
 */
class AuthController extends BaseController
{
    /**
     * Maneja el proceso de inicio de sesión de usuarios.
     *
     * @return mixed Vista de inicio de sesión o redirección a la página de inicio.
     */
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
        }

        return view("auth/login", [
            "usuario" => $auth,
            "alertas" => $alertas
        ]);
    } 
    
    /* USANDO VALIDATE PARA VALIDAR LOS INPUTS DEL FORMULARIO - OPCION
    public function login(){        
        $alertas = [];
        $auth = new UsuarioEntity();
        $validacion = null;

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $auth = new UsuarioEntity($POST);
            $validacion = \Config\Services::validation();;
            $validacion->setRules([
                "email" => "required|valid_emails",
                "password" => "required"
            ]);
            if($validacion->withRequest($this->request)->run()){
                $usuario = $auth->where("email", $auth->email);
                $auth->password = $usuario[0]->password;
                if($auth->comprobar_password($POST["password"])){
                    session()->set([
                        "id" => $usuario[0]->id,
                        "nombre" => $usuario[0]->nombre
                    ]);
                    return redirect()->to(base_url('/inicio'));
                }
            }
        }

        return view("auth/login", [
            "usuario" => $auth,
            "alertas" => $alertas,
            "validacion" => $validacion
        ]);
    }*/

    
    /**
     * Cierra la sesión de usuario.
     *
     * @return mixed Redirección a la página de inicio.
     */
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('/'));
    }


/*     public function crear(){
        $alertas = [];
        $usuario = new UsuarioEntity();
        $validacion = null;

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
    } */

     /**
     * Crea un nuevo usuario.
     *
     * @return mixed Vista de registro o redirección a la página de mensaje.
     */
    public function crear(){
        $usuario = new UsuarioEntity();

        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $usuario = new UsuarioEntity($POST);
            if($this->validate([
                "nombre" => "required",
                "apellido" => "required",
                "email" => "required|valid_emails|is_unique[usuarios.email]",
                "password" => "required|matches[c-password]"
            ])){
                $usuarioModel = new UsuarioModel();
                $usuarioModel->insert($usuario);
                return redirect()->to(base_url('/mensaje'));
            }else{
                return redirect()->to(base_url('/registro'))->withInput()->with("errors", $this->validator->getErrors());
            }
        }
        return view("auth/registro");
    }

    /**
     * Muestra una página de mensaje.
     *
     * @return mixed Vista de mensaje.
     */
    public function mensaje(){
        return view("auth/mensaje");
    }
}
