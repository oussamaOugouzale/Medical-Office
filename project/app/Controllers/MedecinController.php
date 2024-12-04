<?php
namespace App\Controllers;

use App\Models\MedecinModel;
use App\Models\RdvModel;

class MedecinController extends BaseController
{


    public function editCoordinates()
    {
        $doctorId = session()->get('doctor.id'); // Récupérer l'ID du médecin connecté

        $model = new \App\Models\CoordonneModel();
        $data['coordonnes'] = $model->getCoordinates($doctorId);

        return view('medecin/coordonnes', ['doctor' => $data]);
    }

    public function saveCoordinates()
    {
        $doctorId = session()->get('doctor.id'); // Récupérer l'ID du médecin connecté

        if (!$doctorId) {
            return redirect()->back()->with('error', 'Erreur : Médecin non identifié.');
        }

        $model = new \App\Models\CoordonneModel();

        // Récupérer les données du formulaire
        $data = [
            'adresse' => $this->request->getPost('adresse'),
            'ville' => $this->request->getPost('ville'),
            'tele_fixe' => $this->request->getPost('tele_fixe'),
            'tele_mobile' => $this->request->getPost('tele_mobile'),
            'delegation' => $this->request->getPost('delegation'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
        ];

        // Appeler la méthode de mise à jour des coordonnées
        if ($model->updateCoordinates($doctorId, $data)) {
            return redirect()->back()->with('success', 'Coordonnées mises à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour des coordonnées.');
        }
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
        $userId = session()->get('doctor.id'); // Supposons que l'utilisateur est connecté avec un ID de session

        // Récupérer le patient connecté
        $doctorModel = new MedecinModel();
        $doctor = $doctorModel->find($userId);

        if (!$doctor || !password_verify($oldPassword, $doctor['motDePasse'])) {
            // Si l'ancien mot de passe est incorrect
            return redirect()->back()->withInput()->with('error', 'Mot de passe invalide.');
        }

        // Mettre à jour le mot de passe
        $doctorModel->update($userId, [
            'motDePasse' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        // Retourner un message de succès
        return redirect()->back()->with('success', 'Mot de passe modifié avec succès.');
    }

    public function rdvs()
    {
        // Charger les modèles nécessaires
        $rdvModel = new RdvModel();

        // Obtenir les informations du médecin connecté
        $doctorId = session()->get('doctor.id'); // Supposons que l'ID du médecin est stocké dans la session.

        // Récupérer les rendez-vous associés au médecin
        $rdvs = $rdvModel->where('doctor_id', $doctorId)->findAll();

        // Compter les rendez-vous par état
        $aVenir = $rdvModel->where('etat', 'en attente')->where('doctor_id', $doctorId)->countAllResults();
        $annule = $rdvModel->where('etat', 'annule')->where('doctor_id', $doctorId)->countAllResults();
        $complete = $rdvModel->where('etat', 'accepte')->where('doctor_id', $doctorId)->countAllResults();

        // Vérifier si les rendez-vous existent
        if (empty($rdvs)) {
            return view('medecin/rdvs');
        } else {
            return view('medecin/rdvs', [
                'rdvs' => $rdvs,
                'aVenir' => $aVenir,
                'annule' => $annule,
                'complete' => $complete,
            ]);
        }
    }
    public function index()
    {
        // Charger les données pour la vue
        $rdvModel = new RdvModel();
        $doctorId = session()->get('doctor.id'); // Récupérer l'ID du médecin depuis la session

        if (!$doctorId) {
            return redirect()->to('/loginForm')->with('error', 'Veuillez vous connecter.');
        }

        $data = [
            'totalRdv' => $rdvModel->where('doctor_id', $doctorId)->countAllResults(),
            'patientsToday' => $rdvModel
                ->where('doctor_id', $doctorId)
                ->where('DATE(jour)', date('Y-m-d'))
                ->countAllResults(),
            'rdvs' => $rdvModel
                ->where('doctor_id', $doctorId)
                ->orderBy('jour', 'ASC')
                ->findAll()
        ];

        return view('medecin/dashboard', $data);
    }
    public function cancel()
    {
        $rdvId = $this->request->getPost('rdv_id');
        $rdvModel = new RdvModel();

        $rdv = $rdvModel->find($rdvId);
        if ($rdv) {
            $rdvModel->update($rdvId, ['etat' => 'annule']);
            return $this->response->setJSON(['success' => true, 'message' => 'Rendez-vous annulé avec succès']);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Une erreur est survenue']);
    }

    public function accept()
    {
        $rdvId = $this->request->getPost('rdv_id');
        $rdvModel = new RdvModel();

        $rdv = $rdvModel->find($rdvId);
        if ($rdv) {
            $rdvModel->update($rdvId, ['etat' => 'accepte']);
            return $this->response->setJSON(['success' => true, 'message' => 'Rendez-vous accepté avec succès']);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Une erreur est survenue']);
    }

    public function form(){
        return view('admin/addmed');
    }
    public function edit($id)
    {
        $medecinModel = new MedecinModel();
        $medecin = $medecinModel->find($id);
        
        if (!$medecin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Médecin non trouvé");
        }
        
        return view('/admin/editmed', ['medecin' => $medecin]);
    }
    public function update($id)
{
    $medecinModel = new MedecinModel();
    
    // Fetch the current record
    $medecin = $medecinModel->find($id);
    if (!$medecin) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Médecin non trouvé avec l'ID $id");
    }

    $email = $this->request->getPost('email');

    // Check if the email exists for another doctor
    $existingMedecin = $medecinModel
        ->where('email', $email)
        ->where('id !=', $id) // Exclude current doctor
        ->first();

    if ($existingMedecin) {
        log_message('debug', "Existing Doctor ID: " . $existingMedecin['id']);
        log_message('debug', "Current Doctor ID: " . $id);
        return redirect()->back()->with('error', 'Cette adresse e-mail est déjà utilisée par un autre médecin.');
    }

    // Prepare data for update
    $data = [
        'nom'              => $this->request->getPost('nom'),
        'prenom'           => $this->request->getPost('prenom'),
        'specialite'       => $this->request->getPost('specialite'),
        'telephone'        => $this->request->getPost('telephone'),
        'email'            => $this->request->getPost('email'),
        'genre'            => $this->request->getPost('genre'),
        'salleConsultation'=> $this->request->getPost('salleConsultation'),
    ];

    // Update password only if provided
    $newPassword = $this->request->getPost('motDePasse');
    if (!empty($newPassword)) {
        $data['motDePasse'] = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    // Save changes
    if ($medecinModel->update($id, $data)) {
        // Prepare updated fields summary for email
        $updatedFields = [];
        foreach ($data as $key => $value) {
            if ($key === 'motDePasse') continue; // Skip hashed password in comparison

            // Compare and collect only updated fields
            if ($value != $medecin[$key]) {
                $updatedFields[] = ucfirst($key) . ": " . $medecin[$key] . " -> " . $value;
            }
        }

        // Include the new password in the email (if changed)
        if (!empty($newPassword)) {
            $updatedFields[] = "Mot de passe: ". $this->request->getPost('motDePasse');
        }

        // Send email notification
        $toEmail = $data['email'];
        $subject = "Mise à jour de vos informations - Doccure";
        $message = "Bonjour " . $data['nom'] . ",\n\n";
        $message .= "Vos informations ont été mises à jour avec succès. Voici les champs modifiés :\n\n";
        $message .= $updatedFields ? implode("\n", $updatedFields) : "Aucun champ modifié.";
        $message .= "\n\nCordialement,\nL'équipe Doccure";

        $emailService = \Config\Services::email();
        $emailService->setTo($toEmail);
        $emailService->setFrom('ayoubboutbibb@gmail.com', 'Doccure Admin');
        $emailService->setSubject($subject);
        $emailService->setMessage($message);

        if (!$emailService->send()) {
            log_message('error', 'Échec de l\'envoi de l\'email à ' . $toEmail);
        }

        return redirect()->to(base_url('/admin-home'))->with('message', 'Médecin mis à jour avec succès.');
    }

    return redirect()->back()->with('errors', $medecinModel->errors())->withInput();
}

    public function create()
    {
        $medecinModel = new MedecinModel();
        $email = $this->request->getPost('email');
        
        $existingMedecin = $medecinModel->where('email', $email)->first();
    
        if ($existingMedecin) {
            return redirect()->back()->with('error', 'Cette adresse e-mail est déjà utilisée.');
        }
        $data = [
            'nom'              => $this->request->getPost('nom'),
            'prenom'           => $this->request->getPost('prenom'),
            'specialite'       => $this->request->getPost('specialite'),
            'telephone'        => $this->request->getPost('telephone'),
            'email'            => $this->request->getPost('email'),
            'genre'            => $this->request->getPost('genre'),
            'salleConsultation'=> $this->request->getPost('salleConsultation'),
            'motDePasse'       => password_hash($this->request->getPost('motDePasse'), PASSWORD_DEFAULT),
        ];
    
        if ($medecinModel->save($data)) {
            $subject = "Bienvenue à Doccure";
            $message = "Bonjour " . $data['nom'] . ",\n\n";
            $message .= "Vous avez été ajouté en tant que médecin à Doccure.\n";
            $message .= "Voici vos informations :\n";
            $message .= "Nom : " . $data['nom'] . "\n";
            $message .= "Spécialité : " . $data['specialite'] . "\n";
            $message .= "Salle de Consultation : " . $data['salleConsultation'] . "\n\n";
            $message .= "Mot de passe : " . $this->request->getPost('motDePasse') . "\n\n";
            $message .= "Cordialement,\nL'équipe Doccure";
    
            $emailService = \Config\Services::email();
            $emailService->setTo($data['email']);
            $emailService->setFrom('ayoubboutbibb@gmail.com', 'Doccure Admin');
            $emailService->setSubject($subject);
            $emailService->setMessage($message);
    
            if ($emailService->send()) {
                return redirect()->to(base_url('/admin-home'))->with('message', 'Médecin ajouté avec succès. Email envoyé.');
            } else {
                log_message('error', $emailService->printDebugger(['headers']));
                return redirect()->to(base_url('/admin-home'))->with('message', 'Médecin ajouté, mais l\'envoi de l\'email a échoué.');
            }
        } else {
            return redirect()->back()->with('errors', $medecinModel->errors());
        }
    }
    

    public function list()
    {
        $medecinModel = new MedecinModel();

        $medecins = $medecinModel->findAll();

        return view('admin/home', ['medecins' => $medecins]);
    }
    public function delete($id)
    {
        $medecinModel = new MedecinModel();
        if ($medecinModel->find($id)) {
            if ($medecinModel->delete($id)) {
                return redirect()->to(base_url('/admin-home'))->with('message', 'Médecin supprimé avec succès.');
            } else {
                return redirect()->to(base_url('/admin-home'))->with('errors', 'Erreur lors de la suppression du médecin.');
            }
        } else {
            return redirect()->to(base_url('/admin-home'))->with('errors', 'Médecin introuvable.');
        }
    }
}
