<?php

namespace App\Controllers;

use App\Models\RdvModel;
use App\Models\PatientModel;
use App\Models\MedecinModel;
use CodeIgniter\Controller;

class RdvController extends Controller
{
    protected $rdvModel;
    protected $patientModel;
    protected $medecinModel;

    public function __construct()
    {
        $this->rdvModel = new RdvModel();
        $this->patientModel = new PatientModel();
        $this->medecinModel = new MedecinModel();
    }


    public function test(){
        $medecinModel = new RdvModel();
        // $medecinModel = new MedecinModel();

        // $medecin = [
        //     'nom'              => "medecin",
        //     'prenom'           => "medprenom",
        //     'specialite'       => "carrdio",
        //     'telephone'        => "02233",
        //     'genre'        => "homme",
        //     'email'            => "medecin@gmail.com",
        //     'salleConsultation'=> "17",
        //     'motDePasse'       => password_hash("doctor", PASSWORD_DEFAULT),
        // ];

        // $medecinModel->save($medecin);

        $rdv = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'motif' => "maladie simple",
            'horaire' =>"10:00",
            'jour' => 'lundi',
            'etat' => 'en attente', 
        ];

        $this->rdvModel->save($rdv);
    }


  


    public function doctorRdv()
    {
        $doctorId = session()->get('doctor.id'); // L'ID du médecin dans la session
        $rdvs = $this->rdvModel->where('doctor_id', $doctorId)->findAll();

        return view('rdv/doctor_rdv', [
            'rdvs' => $rdvs,
        ]);
    }

    // Créer un nouveau rendez-vous
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            // Validation des données de formulaire
            $validation = \Config\Services::validation();
            $validation->setRules([
                'motif' => 'required|string',
                'horaire' => 'required|valid_date',
                'jour' => 'required|valid_date',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation->getErrors());
            }

            // Enregistrer le rendez-vous
            $data = [
                'doctor_id' => $this->request->getPost('doctor_id'),
                'patient_id' => session()->get('patient.id'),
                'motif' => $this->request->getPost('motif'),
                'horaire' => $this->request->getPost('horaire'),
                'jour' => $this->request->getPost('jour'),
                'etat' => 'en attente', // L'état initial du rendez-vous
            ];

            $this->rdvModel->save($data);

            return redirect()->to('/rdv')->with('success', 'Rendez-vous créé avec succès.');
        }

        // Charger la vue pour créer un rendez-vous
        $doctors = $this->medecinModel->findAll();
        return view('rdv/create', [
            'doctors' => $doctors,
        ]);
    }

    // Modifier un rendez-vous existant
    public function edit($id)
    {
        $rdv = $this->rdvModel->find($id);

        if (!$rdv) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rendez-vous non trouvé.');
        }

        if ($this->request->getMethod() === 'post') {
            // Validation des données de formulaire
            $validation = \Config\Services::validation();
            $validation->setRules([
                'motif' => 'required|string',
                'horaire' => 'required|valid_date',
                'jour' => 'required|valid_date',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation->getErrors());
            }

            // Mettre à jour le rendez-vous
            $data = [
                'id' => $id,
                'motif' => $this->request->getPost('motif'),
                'horaire' => $this->request->getPost('horaire'),
                'jour' => $this->request->getPost('jour'),
                'etat' => $this->request->getPost('etat'), // Modifier l'état si nécessaire
            ];

            $this->rdvModel->save($data);

            return redirect()->to('/rdv')->with('success', 'Rendez-vous modifié avec succès.');
        }

        // Charger la vue pour modifier un rendez-vous
        return view('rdv/edit', [
            'rdv' => $rdv,
        ]);
    }

    // Supprimer un rendez-vous
    public function delete($id)
    {
        $rdv = $this->rdvModel->find($id);

        if (!$rdv) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rendez-vous non trouvé.');
        }

        $this->rdvModel->delete($id);

        return redirect()->to('/rdv')->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
