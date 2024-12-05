<?php

namespace App\Controllers;

use App\Models\CoordonneModel;
use App\Models\RdvModel;
use App\Models\PatientModel;
use App\Models\MedecinModel;
use App\Models\SpecialiteModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Twilio\Rest\Client;
use Config\Twilio;
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

    public function store()
    {
        
        $session = session();
        $doctor_id = $session->get('doctor_id');
        $horaire = $session->get('selected_time');
        $jour = $session->get('selected_date');
        $motif = $session->get('motif');
        $patient_id = session()->get('patient.id');

        

        
        if (!$doctor_id || !$patient_id) {
            return $this->response->setJSON(['error' => 'Informations du docteur ou du patient manquantes dans la session.'])->setStatusCode(400);
        }

        try {
            $time = \Carbon\Carbon::createFromFormat('g:i A', $horaire)->format('H:i:s');
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $jour)->toDateString();
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Format de date ou d\'heure invalide.'])->setStatusCode(400);
        }

        
        $rdvModel = new RdvModel();

        
        $rdvModel->insert([
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'motif' => $motif,
            'horaire' => $time,
            'etat' => 'en attente',
            'jour' => $date,
        ]);

        
        return redirect()->route('patient/dashboard');
    }


    public function verifierCode()
    {
        
        $validationRules = [
            'verification_code' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->route('verification-code')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        
        $verificationCode = session()->get('confirmation_code');
        
        if ($this->request->getPost(index: 'verification_code') == $verificationCode) {
            return redirect()->route('rdvStore');
        }

        
        return redirect()->route('verification-code')->with('error', 'Le code de confirmation est incorrect.');
    }

    public function sendCode()
    {
        
        $validationRules = [
            'nom' => 'required|string',
            'motif' => 'required|string',
            'phone' => 'required|numeric|exact_length[10]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        
        $phone = '+212' . substr($this->request->getPost('phone'), 1); 
        $motif = $this->request->getPost('motif'); 
        $code = rand(10000, 99999); 

        
        session()->set([
            'confirmation_code' => $code,
            'motif' => $motif,
            'phone' => $phone,
            'nom' => $this->request->getPost('nom')
        ]);

        

        
        $twilioCredentials = Twilio::getCredentials();

        
        $twilio = new Client($twilioCredentials['sid'], $twilioCredentials['token']);

        
        $twilio->messages->create(
            $phone,
            [
                'from' => $twilioCredentials['from'],
                'body' => 'Bonjour Mr ' . $this->request->getPost('nom') . ', Votre code de confirmation est ' . $code
            ]
        );

        
        return view('code-confirmation');
    }
    public function storeSelectedTime()
    {
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'time' => 'required|string',
            'date' => 'required|string',
        ]);

        if (!$this->validate($validation->getRules())) {
            
            return redirect()->back()->withInput()->with('error', 'Veuillez fournir une date et une heure valides.');
        }

        
        $time = $this->request->getPost('time');
        $date = $this->request->getPost('date');
        $doctor_id = $this->request->getPost('doctor_id');

        
        session()->set([
            'selected_time' => $time,
            'selected_date' => $date,
            'doctor_id' => $doctor_id,
        ]);

        
        return view('rdv-telephone');
    }


    public function prendreRdv($doctor_id)
    {
        $rdvModel = new RdvModel();

        $doctor = $this->medecinModel->find($doctor_id);
        if (!$doctor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Médecin introuvable.');
        }

        
        $rdvs = $rdvModel->where('doctor_id', $doctor_id)->findAll();

        
        $horaires_reserves = [];
        foreach ($rdvs as $rdv) {
            $jour = $rdv['jour'];
            $horaires_reserves[$jour][] = $rdv['horaire'];
        }

        
        $jours = [];
        for ($i = 0; $i < 7; $i++) {
            $jours[] = Time::now()->addDays($i);
        }

        
        $horaires_par_jour = [];
        foreach ($jours as $jour) {
            $date = $jour->toDateString();
            $horaires_par_jour[$date] = $this->generateHorairesForDay($date, $horaires_reserves);
        }

        return view('rdv', [
            'doctor' => $doctor,
            'jours' => $jours,
            'horaires_par_jour' => $horaires_par_jour,
        ]);
    }

    private function generateHorairesForDay(string $date, array $horaires_reserves): array
    {
        $horaires_fixes = [
            '09:00 AM',
            '10:00 AM',
            '11:00 AM',
            '12:00 PM',
            '02:00 PM',
            '03:00 PM',
            '04:00 PM',
            '05:00 PM'
        ];

        $reservedTimes = $horaires_reserves[$date] ?? [];

        $horaires = [];
        foreach ($horaires_fixes as $horaire) {
            $horaireFormate = Time::createFromFormat('g:i A', $horaire)->format('H:i:s');

            $horaires[] = [
                'time' => $horaire,
                'reserved' => in_array($horaireFormate, $reservedTimes),
                'date' => $date,
            ];
        }

        return $horaires;
    }


    public function test()
    {
        $medecinModel = new MedecinModel();
        $coordonneesModel = new CoordonneModel();
        $specialiteModel = new SpecialiteModel();

        
        $medecin = [
            'nom' => "medecin2",
            'prenom' => "medprenom2",
            'genre' => "homme",
            'specialite' => "cardio",
            'telephone' => "02233",
            'email' => "medecin2@gmail.com",
            'salleConsultation' => "17",
            'motDePasse' => password_hash("doctor2", PASSWORD_DEFAULT),
        ];

        
        $medecinModel->save($medecin);
        $medecinId = $medecinModel->getInsertID();

        if ($medecinId) {
            
            $coordonnees = [
                'adresse' => ' Salam, Agadir',
                'ville' => 'Agadir',
                'tele_fixe' => '0145789632',
                'tele_mobile' => '0678529634',
                'delegation' => 'Arrondissement 5',
                'latitude' => '48.8566',
                'longitude' => '2.3522',
                'doctor_id' => $medecinId,
            ];
            if (!$coordonneesModel->save($coordonnees))
                echo "cooord";

            
            $specialites = [
                [
                    'specialite' => 'Cardiologie',
                    'autre_specialite' => 'Interventionnelle',
                    'doctor_id' => $medecinId,
                ],
                [
                    'specialite' => 'dentiste',
                    'autre_specialite' => 'Interventionnelle',
                    'doctor_id' => $medecinId,
                ],

            ];
            if (!$specialiteModel->insertBatch($specialites))
                echo "specialite";
        }
    }






    public function doctorRdv()
    {
        $doctorId = session()->get('doctor.id'); 
        $rdvs = $this->rdvModel->where('doctor_id', $doctorId)->findAll();

        return view('rdv/doctor_rdv', [
            'rdvs' => $rdvs,
        ]);
    }

    
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'motif' => 'required|string',
                'horaire' => 'required|valid_date',
                'jour' => 'required|valid_date',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation->getErrors());
            }

            
            $data = [
                'doctor_id' => $this->request->getPost('doctor_id'),
                'patient_id' => session()->get('patient.id'),
                'motif' => $this->request->getPost('motif'),
                'horaire' => $this->request->getPost('horaire'),
                'jour' => $this->request->getPost('jour'),
                'etat' => 'en attente', 
            ];

            $this->rdvModel->save($data);

            return redirect()->to('/rdv')->with('success', 'Rendez-vous créé avec succès.');
        }

        
        $doctors = $this->medecinModel->findAll();
        return view('rdv/create', [
            'doctors' => $doctors,
        ]);
    }

    
    public function edit($id)
    {
        $rdv = $this->rdvModel->find($id);

        if (!$rdv) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rendez-vous non trouvé.');
        }

        if ($this->request->getMethod() === 'post') {
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'motif' => 'required|string',
                'horaire' => 'required|valid_date',
                'jour' => 'required|valid_date',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation->getErrors());
            }

            
            $data = [
                'id' => $id,
                'motif' => $this->request->getPost('motif'),
                'horaire' => $this->request->getPost('horaire'),
                'jour' => $this->request->getPost('jour'),
                'etat' => $this->request->getPost('etat'), 
            ];

            $this->rdvModel->save($data);

            return redirect()->to('/rdv')->with('success', 'Rendez-vous modifié avec succès.');
        }

        
        return view('rdv/edit', [
            'rdv' => $rdv,
        ]);
    }

    
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
