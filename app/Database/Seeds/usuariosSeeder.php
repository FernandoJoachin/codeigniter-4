<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class usuariosSeeder extends Seeder{
    public function run(){
        $data = [
            "nombre" => "Jane",
            "apellido" => "Doe",
            "email"    => "prueba@correo.com",
            "password" => "prueba123",
        ];

        // Using Query Builder
        $this->db->table("usuarios")->insert($data);
    }
}