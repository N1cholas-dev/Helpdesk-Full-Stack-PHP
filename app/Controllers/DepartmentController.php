<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    // Menampilkan daftar department
    public function index()
    {
        $departments = $this->departmentModel->findAll();
        return view('TASK/departments/department-company', [
            'departments' => $departments
        ]);
    }

    // Menampilkan form tambah department
    public function create()
    {
        return view('TASK/departments/create-department');
    }

    public function store()
    {
        $this->departmentModel->insert([
            'name' => $this->request->getPost('department_name')
        ]);

        // Flash data to show success message
        session()->setFlashdata('success', 'Department created successfully');
        return redirect()->to('TASK/departments/department-company');
    }

    public function edit($id)
    {
        $department = $this->departmentModel->find($id);
        return view('TASK/departments/edit-department', [
            'department' => $department
        ]);
    }

    public function update($id)
    {
        $this->departmentModel->update($id, [
            'name' => $this->request->getPost('department_name')
        ]);

        // Flash data to show success message
        session()->setFlashdata('updated', 'Department updated successfully');
        return redirect()->to('TASK/departments/department-company');
    }

    public function delete($id)
    {
        $this->departmentModel->delete($id);

        // Flash data to show delete message
        session()->setFlashdata('deleted', 'Department deleted successfully');
        return redirect()->to('TASK/departments/department-company');
    }

}