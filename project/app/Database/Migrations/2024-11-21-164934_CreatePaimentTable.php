<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaiementTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'montant' => [
                'type' => 'FLOAT',
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'methode' => [
                'type'       => 'ENUM',
                'constraint' => ['Carte', 'Espèces'],
                'default'    => 'Carte',
            ],
            'idPatient' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'idRendezVous' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idPatient', 'patient', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idRendezVous', 'rendezvous', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('paiement');
    }

    public function down()
    {
        $this->forge->dropTable('paiement');
    }
}
