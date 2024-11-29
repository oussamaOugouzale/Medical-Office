<?php

namespace App\Models;

use CodeIgniter\Model;

class RdvModel extends Model
{
    protected $table = 'rendezvous';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'dateHeure',
        'status',
        'patient_id', 
        'medecin_id', 
    ];

    protected $useTimestamps = false;

    /**
     * Récupérer le patient associé au rendez-vous.
     */
    public function getPatient()
    {
        $patientModel = new \App\Models\PatientModel();
        return $patientModel->find($this->patient_id); 
    }

    /**
     * Récupérer le médecin associé au rendez-vous.
     */
    public function getMedecin()
    {
        $medecinModel = new \App\Models\MedecinModel();
        return $medecinModel->find($this->medecin_id); 
    }

    /**
     * Récupérer tous les rendez-vous d'un patient.
     * 
     * @param int $patient_id
     * @return array
     */
    public function getRendezVousByPatient($patient_id)
    {
        return $this->where('patient_id', $patient_id)->findAll();
    }

    /**
     * Récupérer tous les rendez-vous d'un médecin.
     * 
     * @param int $medecin_id
     * @return array
     */
    public function getRendezVousByMedecin($medecin_id)
    {
        return $this->where('medecin_id', $medecin_id)->findAll();
    }
}
