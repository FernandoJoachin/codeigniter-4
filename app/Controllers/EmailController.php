<?php

namespace App\Controllers;

class EmailController extends BaseController
{
    public function email(){
        if($this->request->getServer("REQUEST_METHOD") === "POST"){
            $POST = $this->request->getPost();
            $email = \Config\Services::email();

            $email->setFrom('your@example.com', 'Fernando');
            $email->setTo($POST["email"]);

            $email->setSubject($POST["asunto"]);
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $POST["nombre"] .  ".</strong> Has recibido un correo de CodeIgniter.</p>";
            $contenido .= "<p>Mensaje:</p>";
            $contenido .= "<p>" . $POST["descripcion"] ."</p>";
            $contenido .= "</html>";
            $email->setMessage($contenido);

            $email->send();
            return redirect()->to(base_url('/inicio'));
        }

        return view("pagina/email");
    }
}