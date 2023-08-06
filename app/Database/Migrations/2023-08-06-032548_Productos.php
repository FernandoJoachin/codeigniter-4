<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productos extends Migration{
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
            'precio' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'disponibles' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('productos');
    }

    public function down(){
        $this->forge->dropTable('productos');
    }
}