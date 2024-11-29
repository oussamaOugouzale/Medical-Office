<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRendezVousTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dateHeure' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Confirmé', 'Annulé'],
                'default' => 'Confirmé',
            ],
            'patient_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'medecin_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patient', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('medecin_id', 'medecin', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rendezvous');
    }

    public function down()
    {
        $this->forge->dropTable('rendezvous');
    }
}
