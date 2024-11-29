<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PatientModel;
use App\Models\MedecinModel;
use App\Models\SecretaireModel;
class RegisterController extends BaseController
{

    public function index(): string
    {
        return view('register');
    }



    public function register()
    {
        // Définir les règles de validation
        $validationRules = [
            'nom' => 'required|min_length[2]|max_length[50]',
            'prenom' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'numéro' => 'required|numeric|min_length[10]|max_length[15]',
            'password' => 'required|min_length[6]',
            'genre' => 'required|in_list[homme,femme]',
            'user_type' => 'required|in_list[patient,doctor,secretaire]',
        ];

        if (!$this->validate($validationRules)) {
            // Rediriger avec erreurs de validation et données saisies
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        // Vérifier si l'email existe déjà
        $email = $this->request->getPost('email');

        $patientModel = new PatientModel();
        $medecinModel = new MedecinModel();
        $secretaireModel = new SecretaireModel();

        if (
            $patientModel->where('email', $email)->first() ||
            $medecinModel->where('email', $email)->first() ||
            $secretaireModel->where('email', $email)->first()
        ) {
            // Rediriger avec un message d'erreur pour l'email
            return redirect()->back()->withInput()->with('emailExists', 'Un compte avec cet email existe déjà.');
        }

        // Récupérer les données du formulaire
        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $email,
            'telephone' => $this->request->getPost('numéro'),
            'genre' => $this->request->getPost('genre'),
            'motDePasse' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $userType = $this->request->getPost('user_type'); // Type d'utilisateur

        // Sauvegarder selon le type d'utilisateur
        if ($userType === 'patient') {
            $patientModel->save($data);
        } elseif ($userType === 'doctor') {
            $medecinModel->save($data);
        } elseif ($userType === 'secretaire') {
            $secretaireModel->save($data);
        } else {
        }

        // Rediriger après succès
        return redirect('loginForm')->with('user_added', 'Votre compte a été créé avec succès!');
    }



}
