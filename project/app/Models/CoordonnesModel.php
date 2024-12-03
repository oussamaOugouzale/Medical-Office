<?php

namespace App\Models;

use CodeIgniter\Model;

class CoordonneesModel extends Model
{
    protected $table = 'coordonnes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'adresse',
        'ville',
        'tele_fixe',
        'tele_mobile',
        'delegation',
        'latitude',
        'longitude',
        'partCompleted',
        'doctor_id',
    ];

    protected $useTimestamps = false;

    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'adresse' => 'required|max_length[255]',
        'ville' => 'required|max_length[255]',
        'tele_fixe' => 'required|max_length[50]',
        'tele_mobile' => 'required|max_length[50]',
        'latitude' => 'permit_empty|max_length[50]',
        'longitude' => 'permit_empty|max_length[50]',
        'doctor_id' => 'required|integer',
    ];

    public function getDoctor()
    {
        $doctorModel = new \App\Models\MedecinModel();

        return $doctorModel->find($this->doctor_id);
    }
}
