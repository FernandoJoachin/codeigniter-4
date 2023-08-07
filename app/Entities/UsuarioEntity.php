<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UsuarioEntity extends Entity
{
    protected static $alertas = [];
    
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas["error"][] = "El Email del Usuario es Obligatorio";
        }
        if(!$this->password) {
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        return self::$alertas;
    }

    public function validar_cuenta() {
        if(!$this->nombre) {
            self::$alertas["error"][] = "El Nombre es Obligatorio";
        }
        if(!$this->apellido) {
            self::$alertas["error"][] = "El Apellido es Obligatorio";
        }
        if(!$this->email) {
            self::$alertas["error"][] = "El Email es Obligatorio";
        }
        if(!$this->password) {
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        if(strlen($this->password) < 6) {
            self::$alertas["error"][] = "El password debe contener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    public function password_encryptado(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function comprobar_password($passwordComprobar){
        return password_verify($passwordComprobar, $this->password);
    }

    public function where($columna,$valor){
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios')->where($columna, $valor);
        $query = $builder->get()->getResult();
        return $query;
    }
}