<?php
namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends BaseController
{

    public function index()
    {
        return view('admin/home');
    }
    public function create()
    {
        $adminModel = new AdminModel();

        $data = [
            'nom' => "admin",
            'prenom' => "adp",
            'email' => "admin@gmail.com",
            'motDePasse' => password_hash("admin", PASSWORD_DEFAULT),
        ];
        $adminModel->insert($data);

    }

    public function list()
    {
        $adminModel = new AdminModel();

        $medecins = $adminModel->findAll();

        return view('medecin/list', ['medecins' => $medecins]);
    }
}
