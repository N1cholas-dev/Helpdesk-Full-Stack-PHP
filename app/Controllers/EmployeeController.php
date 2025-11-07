<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\GroupModel;
use App\Models\GroupEmployeeModel;
use App\Models\PicModel;
use App\Models\EmployeeHistoryModel;  // Perbaiki baris ini
use CodeIgniter\Controller;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;
    protected $groupModel;
    protected $groupEmployeeModel;
    protected $picModel;
    protected $employeeHistoryModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->groupModel = new GroupModel();
        $this->groupEmployeeModel = new GroupEmployeeModel();
        $this->picModel = new PicModel();
        $this->employeeHistoryModel = new EmployeeHistoryModel();  // Pastikan ini sudah benar
    }

    public function new()
    {
        $departments = $this->departmentModel->findAll();
        $employees = $this->employeeModel
            ->select('employees.*, departments.name as department_name')
            ->join('departments', 'departments.id = employees.department')
            ->findAll();

        return view('ORGANIZE/employee/new', [
            'employees' => $employees,
            'departments' => $departments
        ]);
    }

    public function save()
{
    $rules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'department' => 'required',
        'role' => 'required',
        'date_of_joining' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        'name' => $this->request->getVar('name'),
        'email' => $this->request->getVar('email'),
        'department' => $this->request->getVar('department'),
        'role' => $this->request->getVar('role'),
        'date_of_joining' => $this->request->getVar('date_of_joining')
    ];

    $existingEmployee = $this->employeeModel->where('email', $data['email'])->first();

    if ($existingEmployee) {
        $this->employeeModel->update($existingEmployee['id'], $data);

        return redirect()->to(site_url('ORGANIZE/employee/new'))
            ->with('message', 'Employee updated successfully!')
            ->with('message_type', 'update');
    } else {
        // Insert employee baru
        $this->employeeModel->save($data);
        $employeeId = $this->employeeModel->getInsertID();

        // Catat history join
        $historyModel = new \App\Models\EmployeeHistoryModel();
        $historyModel->save([
            'employee_id' => $employeeId,
            'name' => $data['name'],
            'action' => 'join',
            'action_date' => $data['date_of_joining'],
            'note' => 'New employee joined'
        ]);

        return redirect()->to(site_url('ORGANIZE/employee/new'))
            ->with('message', 'Employee added successfully!')
            ->with('message_type', 'create');
    }
}

    public function edit($id)
    {
        $employee = $this->employeeModel->find($id);
        if (!$employee) {
            return redirect()->to('ORGANIZE/employee/new')->with('error', 'Employee not found.');
        }

        $departments = $this->departmentModel->findAll();

        return view('ORGANIZE/employee/edit', [
            'employee' => $employee,
            'departments' => $departments
        ]);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'department' => 'required',
            'role' => 'required',
            'date_of_joining' => 'required'

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'department' => $this->request->getPost('department'),
            'role' => $this->request->getPost('role'),
            'date_of_joining' => $this->request->getPost('date_of_joining')
        ];

        // Update data
        $this->employeeModel->update($id, $data);

        return redirect()->to(site_url('ORGANIZE/employee/new'))
            ->with('message', 'Employee updated successfully!')
            ->with('message_type', 'update');
    }

    public function exit()
    {
        // Ambil data karyawan
        $employeeModel = new \App\Models\EmployeeModel(); // pastikan model sesuai dengan lokasi dan nama modelmu
        $data['employees'] = $employeeModel->findAll(); // ambil semua karyawan

        // Kirim data ke view
        return view('ORGANIZE/employee/exit', $data);
    }

    public function submit()
{
    $rules = [
        'employee_id' => 'required',
        'exit_date' => 'required|valid_date',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Ambil data dari form
    $employeeId = $this->request->getPost('employee_id');
    $exitDate = $this->request->getPost('exit_date');

    // Ambil data karyawan
    $employeeModel = new \App\Models\EmployeeModel();
    $employee = $employeeModel->find($employeeId);

    // Cek jika karyawan memiliki PIC aktif
    $activePic = $this->picModel->where('employee_id', $employeeId)->where('status', 'active')->first();

    if ($activePic) {
    return redirect()->back()
        ->with('error', 'Cannot remove employee, still has active PIC.');
}


    // Hapus data terkait di tabel PIC
    $this->picModel->where('employee_id', $employeeId)->delete();

    // Catat riwayat aksi (exit)
    $historyModel = new \App\Models\EmployeeHistoryModel();
    $historyModel->insert([
        'employee_id'      => $employee['id'],
        'name'             => $employee['name'],
        'email'            => $employee['email'],
        'department'       => $employee['department'],
        'role'             => $employee['role'],
        'date_of_joining'  => $employee['date_of_joining'],
        'action'           => 'exit',         // Aksi exit
        'action_date'      => date('Y-m-d H:i:s')
    ]);

    // Hapus data karyawan
    if ($this->employeeModel->delete($employeeId)) {
        // Redirect dengan pesan sukses
        return redirect()->to(site_url('ORGANIZE/employee/exit'))->with('message', 'Employee exit processed successfully!');
    } else {
        // Jika gagal, tampilkan pesan error
        return redirect()->back()->with('error', 'Failed to remove employee data.');
    }
}

}
