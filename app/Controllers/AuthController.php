<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Entities\UsuarioEntity;

/**
 * Clase que actúa como un controlador para los diferentes servicios
 * para la autenticación de un usuario.
 * 
 * @extends BaseController Clase Base de controlador proporcionada por CodeIgniter.
 */
class AuthController extends BaseController
{
    /**
     * Muestra la vista de inicio de sesión.
     *
     * Este método carga y devuelve la vista correspondiente a la página de inicio de sesión.
     * 
     * @return string La vista renderizada de inicio de sesión.
     */
    public function vistaIniciarSesion(){        
        return view("auth/login");
    }

    /**
     * Muestra la vista de crear usuario.
     *
     * Este método carga y devuelve la vista correspondiente a la página de crear usuario.
     * 
     * @return string La vista renderizada de crear usuario.
     */
    public function vistaCrearUsuario(){
        return view("auth/registro");
    }

    /**
     * Muestra la vista de mensaje.
     *
     * Este método carga y devuelve la vista correspondiente a la página de mensaje la cual avisa que se creó la cuenta.
     * 
     * @return string La vista renderizada de inicio de sesión.
     */
    public function mensaje()
    {
        return view("auth/mensaje");
    }

    /**
     * Inicia la sesión del usuario.
     *
     * Este método crea la sesión del usuario si las credenciales proporcionadas
     * son válidas, en caso de que no lo sean, muestra mensajes de error.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige la página dependiendo de la validación.
     */
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

    /**
     * Crea un nuevo usuario.
     *
     * Este método crea un usuario con las credenciales proporcionadas siempre que 
     * no exista en la base de datos, de lo contrario mostrará mensajes de error.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige la página dependiendo de la validación.
     */
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
                try {
                    $usuarioModel->insert($usuario);
                    return redirect()->to(base_url('/mensaje'));
                } catch (\Throwable $th) {
                    $alertas["error"][] = "Algo salio mal al crear el usuario. Por favor, inténtalo de nuevo.";
                }
            }
        }

        return redirect()->to(base_url('registro'))->withInput()->with('errors', $alertas);
    }

    /**
     * Cierra la sesión del usuario.
     *
     * Este método destruye la sesión actual del usuario y redirige a la página de inicio.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse Redirige a la página principal para volver a autenticarse.
     */
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
