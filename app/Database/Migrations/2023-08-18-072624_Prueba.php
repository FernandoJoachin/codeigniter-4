<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prueba extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'edad' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
           /*  'imagen' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ], */
            'mensaje' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pruebaseeders');
    }

    public function down()
    {
        $this->forge->dropTable('pruebaseeders');
    }
}
