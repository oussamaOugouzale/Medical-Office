<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patient';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'facebook_id',
        'nom',
        'prenom',
        'genre',
        'dateNaissance',
        'telephone',
        'email',
        'age',
        'photo',
        'historiqueMedical',
        'motDePasse',
        'is_active',
    ];



    public function rendezVous()
    {
        $rendezVousModel = new \App\Models\RdvModel();
        return $rendezVousModel->getRendezVousByPatient($this->id);
    }

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'facebook_id' => 'permit_empty|is_unique[patient.facebook_id]',
        'nom' => 'required',
        'prenom' => 'permit_empty',
        'genre' => 'permit_empty',
        'dateNaissance' => 'permit_empty',
        'age' => 'permit_empty',
        'photo' => 'permit_empty',
        'telephone' => 'permit_empty',
        'email' => 'required|valid_email',
        'historiqueMedical' => 'permit_empty',
        'motDePasse' => 'permit_empty',
        'is_active' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'facebook_id' => [
            'is_unique' => 'Cet ID Facebook est déjà utilisé.',
        ],
        'email' => [
            'is_unique' => 'Cet email est déjà utilisé.',
        ],
    ];

    public function createOrUpdateUser($userData)
    {
        $existingUser = $this->where('facebook_id', $userData['facebook_id'])->first();

        if ($existingUser) {
            $this->update($existingUser['id'], $userData);
        } else {
            $this->save($userData);
        }
    }
}
