<?php

namespace App\Controllers;

use App\Models\EmployeeHistoryModel;
use CodeIgniter\Controller;

class HistoryController extends BaseController
{
    public function index()
    {
        $model = new EmployeeHistoryModel();
        $data['history'] = $model->orderBy('action_date', 'DESC')->findAll();
        return view('ORGANIZE/employee/history', $data);
    }
}
