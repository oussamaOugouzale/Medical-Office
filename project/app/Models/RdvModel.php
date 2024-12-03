<?php

namespace App\Models;

use CodeIgniter\Model;

class RdvModel extends Model
{
    protected $table = 'rdv';
    protected $primaryKey = 'id';
    protected $allowedFields = ['doctor_id', 'patient_id', 'motif', 'etat', 'horaire', 'jour'];
    protected $useTimestamps = false; 

    public function doctor()
    {
        return $this->belongsTo(MedecinModel::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'patient_id');
    }
}
