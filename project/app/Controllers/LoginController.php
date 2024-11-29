<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PatientModel;
use App\Models\MedecinModel;
use App\Models\SecretaireModel;
class LoginController extends BaseController
{

    public function index(): string
    {
        return view('login');
    }

    public function login()
    {
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userTypes = [
            'administrateur' => new AdminModel(),
            'patient' => new PatientModel(),
            'medecin' => new MedecinModel(),
            'secretaire' => new SecretaireModel(),
        ];

        $emailFound = false; // Flag pour savoir si un email correspondant existe
        foreach ($userTypes as $role => $model) {
            $user = $model->where('email', $email)->first();

            if ($user) {
                $emailFound = true; // L'email existe dans cette table
                if (password_verify($password, $user['motDePasse'])) {
                    // Connexion réussie
                    session()->set([
                        'isLoggedIn' => true,
                        'userId' => $user['id'],
                        'role' => $role,
                        'userName' => $user['nom'] . ' ' . $user['prenom'],
                    ]);

                    switch ($role) {
                        case 'administrateur':
                            return redirect()->route('admin-home');
                        case 'patient':
                            return redirect()->route('patient-home');
                        case 'medecin':
                            return redirect()->route('medecin-home');
                        case 'secretaire':
                            return redirect()->route('secretaire-home');
                    }
                } else {
                    // Mot de passe incorrect
                    return redirect()->back()
                        ->withInput()
                        ->with('errors', ['password' => 'Mot de passe incorrect']);
                }
            }
        }

        if (!$emailFound) {
            // L'email n'existe pas dans aucune table
            return redirect()->back()
                ->withInput()
                ->with('errors', ['email' => 'Aucun utilisateur trouvé avec cet email']);
        }

        // Si aucune correspondance n'a été trouvée
        return redirect()->back()
            ->withInput()
            ->with('errors', ['email' => 'Email ou mot de passe invalide']);
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->route('login-page');
    }

    public function create()
    {
        $model = new AdminModel();

        $data = [
            'nom' => 'admin',
            'prenom' => 'adp',
            'email' => 'admin1@gmail.com',
            'motDePasse' => password_hash('admin123', PASSWORD_DEFAULT),
        ];

        $model->insert($data);

    }
}
