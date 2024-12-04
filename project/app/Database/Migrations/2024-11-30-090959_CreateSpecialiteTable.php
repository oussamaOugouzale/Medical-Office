<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSpecialiteTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'specialite' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'autre_specialite' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'doctor_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('doctor_id', 'medecin', 'id', 'CASCADE', 'CASCADE');

        // Créer la table `specialites`
        $this->forge->createTable('specialite', true);
    }

    public function down()
    {
        // Supprimer la table si elle existe
        $this->forge->dropTable('specialite', true);
    }
}
