<?php 

namespace App\Models;
	
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'apellido', 'email', 'password'];

    protected static $alertas = [];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? '';
        $this->apellido = $args["apellido"] ?? '';
        $this->email = $args["email"] ?? '';
        $this->password = $args["password"] ?? '';
    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas["error"][] = "El Email del Usuario es Obligatorio";
        }
        if(!$this->password) {
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        return self::$alertas;
    }

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

    public function comprobar_password(){
        return password_verify($this->password_actual, $this->password );
    }

    public function where($columna,$valor){
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios')->where($columna, $valor);
        $query = $builder->get()->getResult();
        return $query;
    }
}