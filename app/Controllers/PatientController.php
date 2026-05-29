<?php

namespace App\Controllers;

use App\Models\PatientModel;

class PatientController extends BaseController
{
    public function index()
    {
        $model = new PatientModel();

        $perPage = 10;

        $sort = $this->request->getGet('sort') ?? 'last_name';
        $dir  = $this->request->getGet('dir') ?? 'asc';
        $search = $this->request->getGet('search');

        $allowedSorts = ['first_name', 'last_name', 'birth_date', 'cnp', 'patient_number'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'last_name';
        }

        if (!in_array($dir, ['asc', 'desc'])) {
            $dir = 'asc';
        }

        if ($search) {
            $model->groupStart()
                ->like('first_name', $search)
                ->orLike('last_name', $search)
                ->orLike('cnp', $search)
                ->groupEnd();
        }

        $patients = $model->orderBy($sort, $dir)
            ->paginate($perPage);

        return view('patients/index', [
            'patients' => $patients,
            'pager' => $model->pager,
            'total' => $model->countAllResults(false),
            'sort' => $sort,
            'dir' => $dir,
            'search' => $search
        ]);
    }

    public function logout()
        {
            session()->destroy();
            return redirect()->to('/login');
        }
}