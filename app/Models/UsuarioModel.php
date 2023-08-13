<?php 

namespace App\Models;
	
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'apellido', 'email', 'password'];

    protected $beforeInsert = ["password_encryptado"]; 

    public function password_encryptado($data){
        $data["data"]["password"] = password_hash($data["data"]["password"], PASSWORD_BCRYPT);
        return $data;
    }
}