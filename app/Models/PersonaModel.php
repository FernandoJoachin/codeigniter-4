<?php 

namespace App\Models;
	
use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', "folder", 'imagen'];
}