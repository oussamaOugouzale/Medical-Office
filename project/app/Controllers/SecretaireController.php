<?php 
namespace App\Controllers;

use App\Models\SecretaireModel;

class SecretaireController extends BaseController
{
    public function index(){
        return view('secretaire/home');
    }
    public function create()
    {
        $secretaireModel = new SecretaireModel();

        $data = [
            'nom'        => $this->request->getPost('nom'),
            'prenom'     => $this->request->getPost('prenom'),
            'telephone'  => $this->request->getPost('telephone'),
            'email'      => $this->request->getPost('email'),
            'motDePasse' => password_hash($this->request->getPost('motDePasse'), PASSWORD_DEFAULT),
        ];

        if ($secretaireModel->save($data)) {
            return redirect()->to('/loginForm')->with('message', 'Secrétaire ajoutée avec succès.');
        } else {
            return redirect()->back()->with('errors', $secretaireModel->errors());
        }
    }
}
