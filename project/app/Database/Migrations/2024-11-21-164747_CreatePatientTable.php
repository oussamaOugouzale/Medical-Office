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
            ],
            'dateNaissance' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
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
            'motDePasse' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
