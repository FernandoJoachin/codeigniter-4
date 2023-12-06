<?php 

namespace App\Models;
	
use CodeIgniter\Model;

/**
 * Clase que representa el modelo de producto para poder trabajar con la tabla correspondiente
 * en la base de datos.
 * 
 * @extends Model Clase padre proporcionada por CodeIgniter.
 */
class ProductoModel extends Model
{
    /**
     * Nombre de la tabla. 
     * 
     * Esta variable hace referencia a la tabla de la base de datos asociada a este modelo.
     *
     * @var string
     */
    protected $table = 'productos';

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
    protected $returnType = 'object';

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
    protected $allowedFields = ['nombre', 'precio', 'disponibles'];
}