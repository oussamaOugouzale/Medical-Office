<?php

namespace App\Models;

use CodeIgniter\Model;

class CoordonneModel extends Model
{
    protected $table = 'coordonne';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'adresse',
        'ville',
        'tele_fixe',
        'tele_mobile',
        'delegation',
        'latitude',
        'longitude',
        'doctor_id',
    ];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'adresse' => 'required|string|max_length[255]',
        'ville' => 'required|string|max_length[255]',
        'tele_fixe' => 'permit_empty|string|max_length[20]',
        'tele_mobile' => 'permit_empty|string|max_length[20]',
        'delegation' => 'required|string|max_length[255]',
        'latitude' => 'required|string|max_length[100]',
        'longitude' => 'required|string|max_length[100]',
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


    public function getCoordinates($doctorId)
    {
        $coordinates = $this->where('doctor_id', $doctorId)->first();

        
        return $coordinates ?: [
            'adresse' => '',
            'ville' => '',
            'tele_fixe' => '',
            'tele_mobile' => '',
            'delegation' => '',
            'latitude' => '',
            'longitude' => '',
        ];
    }
    public function updateCoordinates($doctorId, $data)
    {
        
        $coordinates = $this->where('doctor_id', $doctorId)->first();

        if ($coordinates) {
            
            return $this->update($coordinates['id'], $data);
        } else {
            
            $data['doctor_id'] = $doctorId;
            return $this->insert($data);
        }
    }

}
