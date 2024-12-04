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
        // Charger les services nécessaires
        $session = session();
        $doctor_id = $session->get('doctor_id');
        $horaire = $session->get('selected_time');
        $jour = $session->get('selected_date');
        $motif = $session->get('motif');
        $patient_id = session()->get('patient.id');

        

        // Vérification des données obligatoires
        if (!$doctor_id || !$patient_id) {
            return $this->response->setJSON(['error' => 'Informations du docteur ou du patient manquantes dans la session.'])->setStatusCode(400);
        }

        try {
            $time = \Carbon\Carbon::createFromFormat('g:i A', $horaire)->format('H:i:s');
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $jour)->toDateString();
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Format de date ou d\'heure invalide.'])->setStatusCode(400);
        }

        // Charger le modèle Rdv
        $rdvModel = new RdvModel();

        // Insérer les données dans la base de données
        $rdvModel->insert([
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'motif' => $motif,
            'horaire' => $time,
            'etat' => 'en attente',
            'jour' => $date,
        ]);

        // Redirection vers une route spécifique
        return redirect()->route('patient/dashboard');
    }


    public function verifierCode()
    {
        // Validation des données
        $validationRules = [
            'verification_code' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->route('verification-code')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Récupération du code de confirmation de la session
        $verificationCode = session()->get('confirmation_code');
        // Vérification du code
        if ($this->request->getPost(index: 'verification_code') == $verificationCode) {
            return redirect()->route('rdvStore');
        }

        // Si le code est incorrect, rediriger avec un message d'erreur
        return redirect()->route('verification-code')->with('error', 'Le code de confirmation est incorrect.');
    }

    public function sendCode()
    {
        // Validation des entrées (comme vous l'avez déjà fait)
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

        // Récupération des données validées
        $phone = '+212' . substr($this->request->getPost('phone'), 1); // Format du numéro de téléphone
        $motif = $this->request->getPost('motif'); // Récupération du motif
        $code = rand(10000, 99999); // Génération d'un code de confirmation aléatoire

        // Stockage des informations dans la session
        session()->set([
            'confirmation_code' => $code,
            'motif' => $motif,
            'phone' => $phone,
            'nom' => $this->request->getPost('nom')
        ]);

        

        // Récupération des informations d'identification Twilio
        $twilioCredentials = Twilio::getCredentials();

        // Configuration de Twilio
        $twilio = new Client($twilioCredentials['sid'], $twilioCredentials['token']);

        // Envoi du message via Twilio
        $twilio->messages->create(
            $phone,
            [
                'from' => $twilioCredentials['from'],
                'body' => 'Bonjour Mr ' . $this->request->getPost('nom') . ', Votre code de confirmation est ' . $code
            ]
        );

        // Redirige vers la vue de confirmation du code
        return view('code-confirmation');
    }
    public function storeSelectedTime()
    {
        // Validation des données
        $validation = \Config\Services::validation();
        $validation->setRules([
            'time' => 'required|string',
            'date' => 'required|string',
        ]);

        if (!$this->validate($validation->getRules())) {
            // Si la validation échoue
            return redirect()->back()->withInput()->with('error', 'Veuillez fournir une date et une heure valides.');
        }

        // Récupération des données validées
        $time = $this->request->getPost('time');
        $date = $this->request->getPost('date');
        $doctor_id = $this->request->getPost('doctor_id');

        // Stockage des données dans la session
        session()->set([
            'selected_time' => $time,
            'selected_date' => $date,
            'doctor_id' => $doctor_id,
        ]);

        // Redirection vers la page souhaitée
        return view('rdv-telephone');// Nom de la route ou URL
    }


    public function prendreRdv($doctor_id)
    {
        $rdvModel = new RdvModel();

        $doctor = $this->medecinModel->find($doctor_id);
        if (!$doctor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Médecin introuvable.');
        }

        // Récupérer les rendez-vous réservés
        $rdvs = $rdvModel->where('doctor_id', $doctor_id)->findAll();

        // Grouper les horaires réservés par jour
        $horaires_reserves = [];
        foreach ($rdvs as $rdv) {
            $jour = $rdv['jour'];
            $horaires_reserves[$jour][] = $rdv['horaire'];
        }

        // Générer les 7 prochains jours
        $jours = [];
        for ($i = 0; $i < 7; $i++) {
            $jours[] = Time::now()->addDays($i);
        }

        // Générer les horaires pour tous les jours
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

        // Données du médecin
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

        // Sauvegarde du médecin et récupération de son ID
        $medecinModel->save($medecin);
        $medecinId = $medecinModel->getInsertID();

        if ($medecinId) {
            // Ajouter des coordonnées pour le médecin
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

            // Ajouter une ou plusieurs spécialités pour le médecin
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
