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
        
        $validationRules = [
            'nom' => 'required|min_length[2]|max_length[50]',
            'prenom' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'numéro' => 'required|numeric|min_length[10]|max_length[15]',
            'age' => 'required|numeric|min_length[2]|max_length[15]',
            'password' => 'required|min_length[6]',
            'genre' => 'required|in_list[homme,femme]',
        ];

        if (!$this->validate($validationRules)) {
            
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        
        $email = $this->request->getPost('email');

        $patientModel = new PatientModel();
        $medecinModel = new MedecinModel();

        if (
            $patientModel->where('email', $email)->first() ||
            $medecinModel->where('email', $email)->first()
        ) {
            
            return redirect()->back()->withInput()->with('emailExists', 'Un compte avec cet email existe déjà.');
        }

        
        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $email,
            'telephone' => $this->request->getPost('numéro'),
            'age' => $this->request->getPost('age'),
            'genre' => $this->request->getPost('genre'),
            'motDePasse' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];


        


        
        if ($patientModel->save($data))
            return redirect('loginForm')->with('user_added', 'Votre compte a été créé avec succès!');
        else
        echo "error";
    }



}
