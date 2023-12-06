<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Clase que representa una entidad de usuario.
 *
 * @property int    $id       ID único del usuario.
 * @property string $nombre   Nombre del usuario.
 * @property string $apellido Apellido del usuario.
 * @property string $email    Correo electrónico del usuario.
 * @property string $password Contraseña del usuario.
 */
class UsuarioEntity extends Entity
{
    /**
     * Array estático para almacenar alertas de validación.
     *
     * @var array
     */
    protected static $alertas = [];
    
    /**
     * Valida el inicio de sesión del usuario.
     *
     * @return array Alertas de validación. Si está vacío, la validación fue exitosa.
     */
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
     * Valida la creación de una cuenta de usuario.
     *
     * @return array Alertas de validación. Si está vacío, la validación fue exitosa.
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
     * Encripta la contraseña del usuario utilizando el algoritmo Bcrypt.
     */
    public function password_encryptado(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Comprueba si la contraseña proporcionada coincide con la contraseña almacenada.
     *
     * @param string $passwordComprobar Contraseña a comprobar.
     * @return bool true si la contraseña coincide, false en caso contrario.
     */
    public function comprobar_password($passwordComprobar){
        return password_verify($passwordComprobar, $this->password);
    }

    /**
     * Realiza una consulta WHERE en la base de datos para obtener usuarios que coincidan con los criterios dados.
     *
     * @param string $columna Columna en la que realizar la búsqueda.
     * @param mixed  $valor   Valor a comparar en la búsqueda.
     * @return array Resultado de la consulta.
     */
    public function where($columna,$valor){
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios')->where($columna, $valor);
        $query = $builder->get()->getResult();
        return $query;
    }
}