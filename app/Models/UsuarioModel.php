<?php 

namespace App\Models;
	
use CodeIgniter\Model;
/**
 * Modelo que representa la interacción con la tabla 'usuarios' en la base de datos.
 *
 * @property int    $id       ID único del usuario.
 * @property string $nombre   Nombre del usuario.
 * @property string $apellido Apellido del usuario.
 * @property string $email    Correo electrónico del usuario.
 * @property string $password Contraseña del usuario.
 */
class UsuarioModel extends Model
{
    /**
     * Nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table      = 'usuarios';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si se utiliza autoincremento para la clave primaria.
     *
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Tipo de retorno de las filas de la tabla.
     *
     * @var string
     */
    protected $returnType     = 'array';

    /**
     * Indica si se utiliza soft deletes en la tabla.
     *
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * Campos permitidos para ser insertados o actualizados en la base de datos.
     *
     * @var array
     */
    protected $allowedFields = ['nombre', 'apellido', 'email', 'password'];
    
     /**
     * Método que se ejecuta antes de insertar en la base de datos.
     * Encripta la contraseña utilizando el algoritmo Bcrypt.
     *
     * @param array $data Datos antes de insertar en la base de datos.
     * @return array Datos modificados con la contraseña encriptada.
     */
    protected $beforeInsert = ["password_encryptado"]; 
    
    /**
     * Encripta la contraseña del usuario utilizando el algoritmo Bcrypt.
     *
     * @param array $data Datos antes de insertar en la base de datos.
     * @return array Datos modificados con la contraseña encriptada.
     */
    public function password_encryptado($data){
        $data["data"]["password"] = password_hash($data["data"]["password"], PASSWORD_BCRYPT);
        return $data;
    }
}