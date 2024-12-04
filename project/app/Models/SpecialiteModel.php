<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecialiteModel extends Model
{
    protected $table = 'specialite';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'specialite',
        'autre_specialite',
        'doctor_id',
    ];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'specialite' => 'required|string|max_length[255]',
        'autre_specialite' => 'permit_empty|string|max_length[255]',
        'doctor_id' => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'doctor_id' => [
            'required' => 'L\'identifiant du médecin est requis.',
            'is_natural_no_zero' => 'L\'identifiant du médecin doit être un entier positif.',
        ],
    ];

    public function getByDoctor($doctorId)
    {
        return $this->where('doctor_id', $doctorId)->findAll();
    }
}
