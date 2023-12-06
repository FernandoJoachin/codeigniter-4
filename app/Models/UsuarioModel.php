<?php 

namespace App\Models;
	
use CodeIgniter\Model;

/**
 * Clase que representa el modelo de usuario para poder trabajar con la tabla correspondiente
 * en la base de datos.
 * 
 * @extends Model Clase padre proporcionada por CodeIgniter.
 */
class UsuarioModel extends Model
{
    /**
     * Nombre de la tabla. 
     * 
     * Esta variable hace referencia a la tabla de la base de datos asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Llave primaria.
     * 
     * Esta variable hace referencia al nombre de la columna que sirve como llave primaria 
     * en la tabla de la base de datos.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Usar autoincremento.
     *
     * Indica si se utiliza la autoincrementación para la llave primaria.
     * 
     * @var boolean
     */
    protected $useAutoIncrement = true;

    /**
     * Tipo de retorno.
     * 
     * Indica el tipo de retorno esperado al realizar consultas.
     * 
     * @var string
     */
    protected $returnType = 'array';

    /**
     * Permitir eliminación suave.
     *
     * Indica si se utiliza la eliminación suave en el modelo.
     * 
     * @var boolean
     */
    protected $useSoftDeletes = false;

    /**
     * Campos que componen al modelo.
     * 
     * Incluye las columnas de la tabla del modelo correspondiente en la base de datos.
     *
     * @var array
     */
    protected $allowedFields = ['nombre', 'apellido', 'email', 'password'];

    /**
     * Métodos a ejecutar.
     * 
     * Indica un arreglo de métodos a ejecutar 
     * antes de realizar una inserción en la base de datos.
     *
     * @var array
     */
    protected $beforeInsert = ["password_encryptado"]; 


    /**
     * Encriptar una contraseña.
     *
     * Este método toma un arreglo de datos que contiene la contraseña a encriptar
     * y luego de haber encriptado la contraseña, devuelve el arreglo actualizado. 
     * 
     * @param array $data Arreglo que contiene la contraseña.
     * 
     * @return array Arreglo con la contraseña actualizada.
     */
    public function password_encryptado($data){
        $data["data"]["password"] = password_hash($data["data"]["password"], PASSWORD_BCRYPT);
        return $data;
    }
}