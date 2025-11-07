<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminManagerController extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $admins = $adminModel->findAll();

        return view('ACCOUNT MANAGER/admin/admin-manager', [
            'admins' => $admins
        ]);
    }

    public function create()
    {
        return view('ACCOUNT MANAGER/admin/create');
    }

    public function store()
    {
        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'ADMIN'
        ];

        $adminModel->insert($data);

        session()->setFlashdata([
            'success_type' => 'created',
            'success_message' => 'Admin has been created successfully.'
        ]);
                return redirect()->to('ACCOUNT MANAGER/admin/admin-manager');
    }

    public function edit($id)
    {
        $adminModel = new AdminModel();
        $admin = $adminModel->find($id);

        if (!$admin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin not found');
        }

        return view('ACCOUNT MANAGER/admin/edit', ['admin' => $admin]);
    }

    public function update($id)
    {
        $adminModel = new AdminModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $adminModel->update($id, $data);
        session()->setFlashdata([
            'success_type' => 'updated',
            'success_message' => 'Admin has been updated successfully.'
        ]);
                return redirect()->to('ACCOUNT MANAGER/admin/admin-manager');
    }

    public function delete($id)
    {
        $adminModel = new AdminModel();
        $adminModel->delete($id);

        session()->setFlashdata([
            'success_type' => 'deleted',
            'success_message' => 'Admin has been deleted successfully.'
        ]);
                return redirect()->to('ACCOUNT MANAGER/admin/admin-manager');
    }
}
