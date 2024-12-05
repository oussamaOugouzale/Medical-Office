<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\doctorModel;
use App\Models\MedecinModel;
use App\Models\PatientModel;
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
        $medecinModel = new MedecinModel();

        $emailFound = false; 
        foreach ($userTypes as $role => $model) {
            $user = $model->where('email', $email)->first();

            if ($user) {
                $emailFound = true; 
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

                            if ($patient) {
                                $photoFileName = $patient['photo']; 

                                if (!empty($photoFileName)) {
                                    $photoUrl = $photoFileName; 
                                } else {
                                    $photoUrl = 'uploads/default.jpg'; 
                                }
                            } else {
                                $photoUrl = 'uploads/default.jpg';
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

                            return redirect()->route('patient/dashboard');
                        case 'medecin':
                            $doctor = $medecinModel->where('email', $email)->first();

                            session()->set('doctor_logged_in', true);

                            session()->set('doctor', [
                                'id' => $doctor['id'],
                                'nom' => $doctor['nom'],
                                'prenom' => $doctor['prenom'],
                                'email' => $doctor['email'],
                                'isLoggedIn' => true,
                            ]);
                            return redirect()->route('dashboard'); 
                    }
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->with('errors', ['password' => 'Mot de passe incorrect']);
                }
            }
        }

        return redirect()->back()
            ->withInput()
            ->with('errors', ['email' => 'Email non trouvé']);
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
