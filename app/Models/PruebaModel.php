<?php 

namespace App\Models;
	
use CodeIgniter\Model;

class PruebaModel extends Model
{
    protected $table      = 'pruebaseeders';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuario', "email", 'password', 'telefono', 'edad', 'imagen', 'mensaje'];
}