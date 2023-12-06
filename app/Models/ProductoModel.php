<?php 

namespace App\Models;
	
use CodeIgniter\Model;

/**
 * Modelo que representa la interacción con la tabla 'productos' en la base de datos.
 *
 * @property int    $id           ID único del producto.
 * @property string $nombre       Nombre del producto.
 * @property float  $precio       Precio del producto.
 * @property int    $disponibles  Cantidad disponible en stock del producto.
 */
class ProductoModel extends Model
{
    /**
     * Nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table      = 'productos';

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
    protected $allowedFields = ['nombre', 'precio', 'disponibles'];
}