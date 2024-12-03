<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRdvTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'doctor_id' => ['type' => 'INT', 'unsigned' => true],
            'patient_id' => ['type' => 'INT', 'unsigned' => true],
            'motif' => ['type' => 'VARCHAR', 'constraint' => 255],
            'etat' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'horaire' => ['type' => 'TIME'],
            'jour' => ['type' => 'DATE'],

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('doctor_id', 'medecin', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('patient_id', 'patient', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rdv');
    }

    public function down()
    {
        $this->forge->dropTable('rdv');
    }
}
