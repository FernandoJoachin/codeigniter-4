<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class pruebaSeeder extends Seeder{
    public function run(){
        $faker = Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                "usuario" => $faker->userName(),
                "email" => $faker->email(),
                "password" => $faker->password(),
                "telefono" => $faker->phoneNumber(),
                "edad" => $faker->numberBetween($min = 8, $max = 80),
                //"imagen" => $faker->image($dir = '/pruebaImg', $width = 640, $height = 480),
                "mensaje" => $faker->text($maxNbChars = 100) ,
            ];
        }

        d($data);
        // Using Query Builder
        $this->db->table("pruebaseeders")->insertBatch($data);
    }
}