<?php

namespace App\Controllers;

use App\Models\RdvModel;


class PatientController extends BaseController
{


    public function settings()
    {
        if (!session()->get('patient.isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        
        $patientId = session()->get('patient.id');

        
        $patientModel = new \App\Models\PatientModel();

        
        $patient = $patientModel->find($patientId);

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient non trouvé.');
        }

        
        return view('patient/pat-profile-settings', ['patient' => $patient]);
    }


    public function index()
    {
        return view('patient/pat-appointments');
    }
    public function test()
    {
        echo "hello world";
    }





    public function information()
    {
        
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/loginForm')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $patientId = session()->get('patient.id');
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'genre' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'numero_tel' => 'required',
            'email' => "required|valid_email",
            'age' => 'required',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,4096]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        
        $patientModel = new \App\Models\PatientModel();

        
        $patient = $patientModel->find($patientId);

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient non trouvé.');
        }

        

        $patient['genre'] = $this->request->getPost('genre');
        $patient['nom'] = $this->request->getPost('nom');
        $patient['prenom'] = $this->request->getPost('prenom');
        $patient['telephone'] = $this->request->getPost('numero_tel');
        $patient['email'] = $this->request->getPost('email');
        $patient['age'] = $this->request->getPost('age');



        
        if ($this->request->getFile('photo')->isValid()) {
            $photoFile = $this->request->getFile('photo');

            
            if (!$photoFile->isValid()) {
                return redirect()->back()->with('error', 'Le fichier uploadé est invalide.');
            }

            
            if ($photoFile->getSize() > 4096 * 1024) {
                return redirect()->back()->with('error', 'La taille de la photo dépasse la limite autorisée de 4 MB.');
            }

            
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($photoFile->getMimeType(), $validMimeTypes)) {
                return redirect()->back()->with('error', 'Le fichier doit être une image de type JPEG, PNG ou GIF.');
            }

            
            $photoFileName = time() . '_' . $photoFile->getClientName();

            try {
                
                $photoFile->move(WRITEPATH . '../public/uploads', $photoFileName); 

                
                $patient['photo'] = 'uploads/' . $photoFileName; 

                

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Une erreur est survenue lors de la sauvegarde du fichier : ' . $e->getMessage());
            }

            session()->set('patient', [
                'id' => $patientId,
                'genre' => $patient['genre'],
                'nom' => $patient['nom'],
                'prenom' => $patient['prenom'],
                'email' => $patient['email'],
                'age' => $patient['age'],
                'photo' => $patient['photo'],
                'isLoggedIn' => true,
            ]);




        } else {
            return redirect()->back()->with('error', 'Aucun fichier valide n’a été uploadé.');
        }


        
        
        
        
        
        


        
        

        if ($patientModel->update($patientId, $patient)) {
            return redirect('patient-profile-settings')->with('success', 'Informations mises à jour avec succès !');
        } else {
            $errors = $patientModel->errors();
            return redirect()->back()->with('error', 'Erreur : ' . implode(', ', $errors));
        }



    }


    public function create()
    {
        $patientModel = new \App\Models\PatientModel();
        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'dateNaissance' => $this->request->getPost('dateNaissance'),
            'telephone' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
            'age' => $this->request->getPost('age'),
            'genre' => $this->request->getPost('genre'),
            'historiqueMedical' => $this->request->getPost('historiqueMedical'),
            'motDePasse' => password_hash($this->request->getPost('motDePasse'), PASSWORD_DEFAULT),
        ];

        
        
        
        
        
        
        
        
        
        




        if ($patientModel->save($data)) {
            return redirect()->to('/loginForm')->with('message', 'Patient ajouté avec succès.');
        } else {
            var_dump($patientModel->errors());
        }
    }


    public function appointment()
    {
        
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        
        $userName = session()->get('userName');

        $patientId = session()->get('patient.id');

        
        $patientModel = new \App\Models\PatientModel();

        
        $patient = $patientModel->find($patientId);
        $photo = $patient['photo'];

        

        
        $userParts = explode(' ', $userName);
        $user = (object) [
            'nom' => $userParts[0],
            'prenom' => $userParts[1] ?? ''
        ];


        
        $rdvModel = new RdvModel();
        $rdvs = $rdvModel->where('patient_id', session()->get('userId'))->findAll();

        
        

        
        $aVenir = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', null)->countAllResults();
        $annule = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', 'annule')->countAllResults();
        $complete = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', 'accepte')->countAllResults();

        
        return view('patient/pat-appointments', [
            'rdvs' => $rdvs,
            'aVenir' => $aVenir,
            'annule' => $annule,
            'complete' => $complete,
            'user' => $user,
            'photo' => $photo
        ]);
    }


    public function password()
    {
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min_length[8]|matches[newPassword_confirmation]',
            'newPassword_confirmation' => 'required|string|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        
        $oldPassword = $this->request->getPost('oldPassword');
        $newPassword = $this->request->getPost('newPassword');
        $userId = session()->get('patient.id'); 

        
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($userId);

        if (!$patient || !password_verify($oldPassword, $patient['motDePasse'])) {
            
            return redirect()->back()->withInput()->with('error', 'Mot de passe invalide.');
        }

        
        $patientModel->update($userId, [
            'motDePasse' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        
        return redirect()->back()->with('success', 'Mot de passe modifié avec succès.');
    }




}
