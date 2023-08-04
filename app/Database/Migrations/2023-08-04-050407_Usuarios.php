<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'apellido' => [
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }

    public function down(){
        $this->forge->dropTable('usuarios');
    }
}
