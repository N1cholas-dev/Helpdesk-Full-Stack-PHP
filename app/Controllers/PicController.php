<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PicModel;
use App\Models\CategoryModel;
use App\Models\EmployeeModel;

class PicController extends BaseController
{
    protected $picModel;
    protected $categoryModel;
    protected $employeeModel;

    public function __construct()
    {
        $this->picModel = new PicModel();
        $this->categoryModel = new CategoryModel();
        $this->employeeModel = new EmployeeModel();
    }

    // Menampilkan daftar PIC dan form tambah PIC
    public function index()
    {
        $pics = $this->picModel->findAll();
        $categories = $this->categoryModel->findAll();
        $employees = $this->employeeModel->findAll();

        return view('ORGANIZE/pic/pic-IT', [
            'pics' => $pics,
            'categories' => $categories,
            'employees' => $employees
        ]);
    }

    // Menyimpan PIC baru
    public function store()
    {
        // Validasi input
        $rules = [
            'employee_id' => 'required|integer',
            'category_id' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Input tidak valid');
        }

        // Ambil data employee berdasarkan employee_id
        $employee = $this->employeeModel->find($this->request->getPost('employee_id'));
        if (!$employee) {
            return redirect()->back()->withInput()->with('error', 'Employee tidak ditemukan');
        }

        // **Cek apakah sudah ada PIC dengan nama yang sama**
        $existingPic = $this->picModel->where('name', $employee['name'])->first();
        if ($existingPic) {
            return redirect()->back()->withInput()->with('error', 'PIC dengan nama ini sudah ada!');
        }

        // Simpan ke database jika belum ada
        $this->picModel->insert([
            'name' => $employee['name'],
            'category_id' => $this->request->getPost('category_id'),
            'status' => 'Non-Active',
            'employee_id' => $this->request->getPost('employee_id')
        ]);
        

        return redirect()->to('ORGANIZE/pic/pic-IT')->with('message', 'PIC berhasil ditambahkan');
    }
    
    // Menghapus PIC
    public function delete($id)
    {
        if ($this->picModel->find($id)) {
            $this->picModel->delete($id);
            return redirect()->to('ORGANIZE/pic/pic-IT')->with('success', 'PIC berhasil dihapus');
        }

        return redirect()->to('
        ORGANIZE/pic/pic-IT')->with('error', 'PIC tidak ditemukan');
    }

    // Update status PIC via AJAX
    public function updateStatus($id)
    {
        $status = $this->request->getJSON()->status; // Mendapatkan status dari request body

        // Lakukan update status di database berdasarkan ID
        $model = new PicModel(); // Gunakan model yang sesuai
        $update = $model->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
