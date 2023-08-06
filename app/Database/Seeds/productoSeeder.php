<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class productoSeeder extends Seeder{
    public function run(){
        $data = [
            "nombre" => "Xbox Series X",
            "precio" => 8000,
            "disponibles" => 30
        ];

        // Using Query Builder
        $this->db->table("productos")->insert($data);
    }
}