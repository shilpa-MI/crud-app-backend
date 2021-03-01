<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTruck extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'zip' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => true,
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('status_id' , 'status' , 'id' , '' , '');
        $this->forge->createTable('truck');


    }

    public function down()
    {
        //
    }
}
