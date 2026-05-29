<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'birth_date',
        'cnp',
        'patient_number'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}