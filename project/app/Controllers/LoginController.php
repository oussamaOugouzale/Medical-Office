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
    public function test()
    {
        echo "hi";
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
        ];

        $patientModel = new PatientModel();


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
                            $patient = $patientModel->where('email', $email)->first();

                            // Vérifiez si le patient existe
                            if ($patient) {
                                // Récupérer le chemin de la photo à partir de la base de données
                                $photoFileName = $patient['photo']; // Cela devrait être 'uploads/1733177444_cropped-abdelhak-Photoroom.png'

                                // Vérifiez si le nom du fichier n'est pas vide
                                if (!empty($photoFileName)) {
                                    // Construire l'URL complète du fichier
                                    $photoUrl = $photoFileName; // URL dynamique pour accéder au fichier
                                } else {
                                    // Image par défaut si aucune photo n'est définie
                                    $photoUrl = 'uploads/default.jpg'; // Image par défaut dans le répertoire public
                                }
                            } else {
                                // Si le patient n'est pas trouvé, gérer le cas (par exemple, définir une image par défaut)
                                $photoUrl = 'uploads/default.jpg'; // Image par défaut si le patient n'existe pas
                            }

                            session()->set('patient_logged_in', true);




                            session()->set('patient', [
                                'id' => $patient['id'],
                                'nom' => $patient['nom'],
                                'prenom' => $patient['prenom'],
                                'email' => $patient['email'],
                                'photo' => $photoUrl,
                                'isLoggedIn' => true,
                            ]);

                            return redirect()->route(route: 'patient/dashboard');
                        case 'medecin':
                            return redirect()->route('medecin-home');
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
        return redirect()->route('loginForm');
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
