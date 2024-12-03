<?php

namespace App\Controllers;

use App\Models\RdvModel;


class PatientController extends BaseController
{


    public function settings()
    {
        // Vérification de la session et de l'état de connexion
        if (!session()->get('patient.isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérer l'ID du patient depuis la session
        $patientId = session()->get('patient.id');

        // Charger le modèle PatientModel
        $patientModel = new \App\Models\PatientModel();

        // Récupérer les informations du patient
        $patient = $patientModel->find($patientId);

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient non trouvé.');
        }

        // Envoyer les données à la vue
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
        // Vérification de la session et de l'état de connexion
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/loginForm')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $patientId = session()->get('patient.id');
        // Validation des données
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

        // Charger le modèle PatientModel
        $patientModel = new \App\Models\PatientModel();

        // Récupérer le patient à partir de la session
        $patient = $patientModel->find($patientId);

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient non trouvé.');
        }

        // Mise à jour des informations

        $patient['genre'] = $this->request->getPost('genre');
        $patient['nom'] = $this->request->getPost('nom');
        $patient['prenom'] = $this->request->getPost('prenom');
        $patient['telephone'] = $this->request->getPost('numero_tel');
        $patient['email'] = $this->request->getPost('email');
        $patient['age'] = $this->request->getPost('age');



        // Gestion de la photo
        if ($this->request->getFile('photo')->isValid()) {
            $photoFile = $this->request->getFile('photo');

            // Vérification des erreurs potentielles de l'upload
            if (!$photoFile->isValid()) {
                return redirect()->back()->with('error', 'Le fichier uploadé est invalide.');
            }

            // Vérification de la taille (max 4MB = 4096 KB)
            if ($photoFile->getSize() > 4096 * 1024) {
                return redirect()->back()->with('error', 'La taille de la photo dépasse la limite autorisée de 4 MB.');
            }

            // Vérification du type MIME
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($photoFile->getMimeType(), $validMimeTypes)) {
                return redirect()->back()->with('error', 'Le fichier doit être une image de type JPEG, PNG ou GIF.');
            }

            // Génération d'un nom unique pour le fichier
            $photoFileName = time() . '_' . $photoFile->getClientName();

            try {
                // Déplacer le fichier vers le répertoire public/uploads
                $photoFile->move(WRITEPATH . '../public/uploads', $photoFileName); // Utilisez '../public/uploads' pour accéder à public/uploads depuis writable

                // Mettre à jour le chemin de la photo
                $patient['photo'] = 'uploads/' . $photoFileName; // Conservez le chemin relatif pour la base de données

                // Mettre à jour la session avec la nouvelle photo

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


        // Sauvegarder les modifications
        // if ($patientModel->save($patient)) {
        //     // Mettre à jour la session avec les nouvelles données
        //     session()->set('patient.nom', $patient['nom']);
        //     session()->set('patient.prenom', $patient['prenom']);
        //     session()->set('patient.email', $patient['email']);


        //     return redirect()->back()->with('success', 'Informations mises à jour avec succès !');
        // }

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

        // $data = [
        //     'nom'              => 'patient1',
        //     'prenom'           => 'patientprenom1',
        //     'dateNaissance'    => '1985-07-15', // Format : AAAA-MM-JJ
        //     'telephone'        => '0612345678',
        //     'email'            => 'patient1@gmail.com',
        //     'genre'            => 'homme',
        //     'historiqueMedical'=> 'Aucun antécédent médical significatif. Allergie connue : pollen.',
        //     'motDePasse'       => password_hash('patient1', PASSWORD_DEFAULT),
        // ];




        if ($patientModel->save($data)) {
            return redirect()->to('/loginForm')->with('message', 'Patient ajouté avec succès.');
        } else {
            var_dump($patientModel->errors());
        }
    }


    public function appointment()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Récupérer l'utilisateur à partir de la session
        $userName = session()->get('userName');

        $patientId = session()->get('patient.id');

        // Charger le modèle PatientModel
        $patientModel = new \App\Models\PatientModel();

        // Récupérer les informations du patient
        $patient = $patientModel->find($patientId);
        $photo = $patient['photo'];

        

        // Séparer le nom et le prénom si vous stockez 'userName' comme 'nom prenom'
        $userParts = explode(' ', $userName);
        $user = (object) [
            'nom' => $userParts[0],
            'prenom' => $userParts[1] ?? ''
        ];


        // Récupérer les rendez-vous
        $rdvModel = new RdvModel();
        $rdvs = $rdvModel->where('patient_id', session()->get('userId'))->findAll();

        // print_r($rdvs);
        // exit;

        // Compter les différents états des rendez-vous
        $aVenir = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', null)->countAllResults();
        $annule = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', 'annule')->countAllResults();
        $complete = $rdvModel->where('patient_id', session()->get('userId'))->where('etat', 'accepte')->countAllResults();

        // Retourner la vue avec les données
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
        // Validation des champs
        $validation = \Config\Services::validation();
        $validation->setRules([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min_length[8]|matches[newPassword_confirmation]',
            'newPassword_confirmation' => 'required|string|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        // Récupérer les données du formulaire
        $oldPassword = $this->request->getPost('oldPassword');
        $newPassword = $this->request->getPost('newPassword');
        $userId = session()->get('patient.id'); // Supposons que l'utilisateur est connecté avec un ID de session

        // Récupérer le patient connecté
        $patientModel = new \App\Models\PatientModel();
        $patient = $patientModel->find($userId);

        if (!$patient || !password_verify($oldPassword, $patient['motDePasse'])) {
            // Si l'ancien mot de passe est incorrect
            return redirect()->back()->withInput()->with('error', 'Mot de passe invalide.');
        }

        // Mettre à jour le mot de passe
        $patientModel->update($userId, [
            'motDePasse' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        // Retourner un message de succès
        return redirect()->back()->with('success', 'Mot de passe modifié avec succès.');
    }




}
