<?php 

namespace App\Models;
	
use CodeIgniter\Model;

/**
 * Modelo que representa la interacción con la tabla 'pruebaseeders' en la base de datos.
 *
 * @property int    $id       ID único de la prueba.
 * @property string $usuario  Nombre de usuario en la prueba.
 * @property string $email    Correo electrónico en la prueba.
 * @property string $password Contraseña en la prueba.
 * @property string $telefono Número de teléfono en la prueba.
 * @property int    $edad     Edad en la prueba.
 * @property string $imagen   Ruta de la imagen en la prueba.
 * @property string $mensaje  Mensaje en la prueba.
 */
class PruebaModel extends Model
{
    /**
     * Nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table      = 'pruebaseeders';

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
    protected $returnType     = 'object';

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
    protected $allowedFields = ['usuario', "email", 'password', 'telefono', 'edad', 'imagen', 'mensaje'];
}