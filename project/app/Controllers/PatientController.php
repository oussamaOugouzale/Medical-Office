<?php

namespace App\Controllers;


class PatientController extends BaseController
{

    public function index()
    {
        return view('patient/home');
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
}
