<?php

namespace App\Models;

use CodeIgniter\Model;

class SecretaireModel extends Model
{
    protected $table = 'secretaire'; 
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom',
        'prenom',
        'genre',
        'telephone',
        'email',
        'motDePasse',
    ];

    protected $useTimestamps = false; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nom'        => 'required|string|max_length[100]',
        'prenom'     => 'required|string|max_length[100]',
        'genre'     => 'required|string|max_length[100]',
        'telephone'  => 'required|string|max_length[15]',
        'email'      => 'required|valid_email|is_unique[secretaire.email]',
        'motDePasse' => 'required|string|min_length[8]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Cette adresse email est déjà utilisée.',
        ],
        'motDePasse' => [
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ],
    ];
}