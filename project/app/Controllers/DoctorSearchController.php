<?php

namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\MedecinModel;

class DoctorSearchController extends BaseController
{
    public function search()
    {
        $request = service('request'); 

        if (!$request->getVar('nom') && !$request->getVar('localisation') && !$request->getVar('specialite')) {
            return redirect()->back()->with('error', 'Veuillez remplir au moins un champ de recherche.');
        }

        $doctorModel = new MedecinModel();

        $query = $doctorModel->select('*');

        if ($request->getVar('nom')) {
            $query->like('nom', match: $request->getVar('nom'));
        }

        if ($request->getVar('localisation')) {
            $query->join('coordonne', 'coordonne.doctor_id = medecin.id')
                ->like('coordonne.adresse', $request->getVar('localisation'));
        }

        if ($request->getVar('specialite')) {
            $query->join('specialite', 'specialite.doctor_id = medecin.id')
                ->like('specialite.specialite', $request->getVar('specialite'));
        }

        $doctors = $query->findAll();

        if (empty($doctors)) {
            return redirect()->back()->with('notfound', 'Aucun résultat trouvé.');
        }

        return view('doctors', ['doctors' => $doctors]);
    }

    public function show($id)
    {
        $doctorModel = new MedecinModel();
        $doctor = $doctorModel->find($id);

        if (!$doctor) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Médecin introuvable.");
        }

        return view('doctors', ['doctor' => $doctor]);
    }
}
