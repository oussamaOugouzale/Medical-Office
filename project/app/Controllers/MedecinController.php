<?php 
namespace App\Controllers;

use App\Models\MedecinModel;

class MedecinController extends BaseController
{

    public function index(){
        return view('medecin/home');
    }
    public function create()
    {
        $medecinModel = new MedecinModel();

        $data = [
            'nom'              => $this->request->getPost('nom'),
            'prenom'           => $this->request->getPost('prenom'),
            'specialite'       => $this->request->getPost('specialite'),
            'telephone'        => $this->request->getPost('telephone'),
            'email'            => $this->request->getPost('email'),
            'salleConsultation'=> $this->request->getPost('salleConsultation'),
            'motDePasse'       => password_hash($this->request->getPost('motDePasse'), PASSWORD_DEFAULT),
        ];

        if ($medecinModel->save(row: $data)) {
            return redirect()->to('/loginForm')->with('message', 'Médecin ajouté avec succès.');
        } else {
            return redirect()->back()->with('errors', $medecinModel->errors());
        }
    }

    public function list()
    {
        $medecinModel = new MedecinModel();

        $medecins = $medecinModel->findAll();

        return view('medecin/list', ['medecins' => $medecins]);
    }
}
