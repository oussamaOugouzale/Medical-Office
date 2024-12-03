<?php

namespace App\Models;

use CodeIgniter\Model;

class Specialite extends Model
{
    protected $table = 'specialites';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'specialite',
        'autre_specialite',
        'doctor_id',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     */
    public function getDoctor()
    {
        $doctorModel = new \App\Models\MedecinModel();
        return $doctorModel->find($this->doctor_id); // 
    }
}
