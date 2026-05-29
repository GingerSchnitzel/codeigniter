<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PatientSeeder extends Seeder
{
   public function run()
{
    $data = [
        [
            'first_name' => 'Ion',
            'last_name' => 'Popescu',
            'birth_date' => '1990-05-12',
            'cnp' => '1900512123456',
            'patient_number' => 'P1001',
        ],
        [
            'first_name' => 'Maria',
            'last_name' => 'Ionescu',
            'birth_date' => '1985-09-20',
            'cnp' => '2850920123456',
            'patient_number' => 'P1002',
        ],
    ];

    $this->db->table('patients')->insertBatch($data);
}
}
