<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class pruebaSeeder extends Seeder{
    public function run(){
        $faker = Factory::create();
        $data = [];
        /*
        $dir = "C:/wamp64/www/codeigniter/prueba";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }*/
        
        for ($i = 0; $i < 2; $i++) {
            $data[] = [
                "usuario" => $faker->userName(),
                "email" => $faker->email(),
                "password" => $faker->password(),
                "telefono" => $faker->phoneNumber(),
                "edad" => $faker->numberBetween($min = 8, $max = 80),
                "imagen" => $faker->imageUrl(640, 480, 'animals', true),
                "mensaje" => $faker->text($maxNbChars = 100) ,
            ];
        }
        // Using Query Builder
        $this->db->table("pruebaseeders")->insertBatch($data);
    }
}