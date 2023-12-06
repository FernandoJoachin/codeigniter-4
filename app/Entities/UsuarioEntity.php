<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Representa una entidad de usuario con métodos para validar la información de la cuenta,
 * encriptar la contraseña y consultar la base de datos en la tabla de usuarios.
 * 
 * @extends Entity Clase padre para representar una entidad
 */
class UsuarioEntity extends Entity
{
    /**
     * Arreglo de mensajes de error.
     *
     * Contiene los mensajes de error correspondientes a las validaciones que no fueron superadas.
     * 
     * @var array
     */
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

    /**
     * Validar la información del producto.
     * 
     * Este método valida los datos de un producto, para luego retornar el arreglo
     * de los errores cuyas validaciones no fueron superadas.
     *
     * @return array Variable que contiene los mensajes de error.
     */
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

    /**
     * Encriptar una contraseña.
     * 
     * Este método encripta la contraseña del objeto de usuario para mejorar la seguridad de su cuenta.
     *
     * @return void
     */
    public function password_encryptado(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Comprobar una contraseña.
     *
     * Este método comprueba si la contraseña ingresada proporcionada por el usuario es la misma 
     * contraseña que tiene su cuenta en la base de datos.
     * 
     * @param string $passwordComprobar Contraseña ingresada por el usuario.
     * 
     * @return bool Retorna TRUE si las contraseñas coinciden, de lo contrario, retorna FALSE.
     */
    public function comprobar_password($passwordComprobar){
        return password_verify($passwordComprobar, $this->password);
    }

    /**
     * Encontrar registros.
     * 
     * Este método encuentra los registros de una consulta en la tabla de usuarios
     * que tengan un valor específico en la columna proporcionada.
     *
     * @param string $columna Columna en donde se buscará el valor.
     * 
     * @param mixed $valor Valor a encontrar en la columna proporcionada.
     * 
     * @return Array Resultado de la consulta.
     */
    public function where($columna, $valor){
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios')->where($columna, $valor);
        $query = $builder->get()->getResult();
        return $query;
    }
}