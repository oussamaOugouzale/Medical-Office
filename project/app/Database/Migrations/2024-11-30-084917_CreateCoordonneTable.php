<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoordonneTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'adresse' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ville' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tele_fixe' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tele_mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'delegation' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'latitude' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                
            ],
            'longitude' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            
            'doctor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);

        // Définir la clé primaire
        $this->forge->addKey('id', true);

        // Définir la clé étrangère vers la table `doctors`
        $this->forge->addForeignKey('doctor_id', 'medecin', 'id', 'CASCADE', 'CASCADE');

        // Créer la table `coordonnes`
        $this->forge->createTable('coordonne');
    }

    public function down()
    {
        // Supprimer la table si elle existe
        $this->forge->dropTable('coordonne', true);
    }
}
