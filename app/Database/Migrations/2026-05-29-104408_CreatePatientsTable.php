<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientsTable extends Migration
{
   public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'first_name' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'last_name' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'birth_date' => [
            'type' => 'DATE',
        ],
        'cnp' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
        ],
        'patient_number' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('patients');
}

public function down()
    {
        $this->forge->dropTable('patients');
    }
}
