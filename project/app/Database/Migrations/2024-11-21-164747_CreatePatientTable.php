<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'facebook_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'prenom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'genre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'dateNaissance' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'historiqueMedical' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'age' => [
                'type' => 'INT',
                'null' => true,
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 400,
                'null' => true,
            ],
            'motDePasse' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true, 
                'null' => false,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('patient');
    }

    public function down()
    {
        $this->forge->dropTable('patient');
    }
}
