<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRendezVousTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dateHeure' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Confirmé', 'Annulé'],
                'default'    => 'Confirmé',
            ],
            'idPatient' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'idMedecin' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idPatient', 'patient', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idMedecin', 'medecin', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rendezvous');
    }

    public function down()
    {
        $this->forge->dropTable('rendezvous');
    }
}
