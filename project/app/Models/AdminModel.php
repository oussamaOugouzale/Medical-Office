<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'administrateur'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['nom', 'prenom', 'email', 'motDePasse'];

    protected $useTimestamps = false;

    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'nom' => 'required|min_length[3]|max_length[100]',
        'prenom' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|max_length[255]|is_unique[administrateur.email]',
        'motDePasse' => 'required|min_length[8]|max_length[255]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Cet email est déjà utilisé.',
        ],
        'motDePasse' => [
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ],
    ];
}
