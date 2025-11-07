<?php

namespace App\Controllers;

use App\Models\PicUserModel;

class PicManagerController extends BaseController
{
    public function index()
    {
        $picUserModel = new PicUserModel();
        $data['picUsers'] = $picUserModel->findAll(); // Ambil semua data dari tabel pic_user

        return view('ACCOUNT MANAGER/pic/pic-manager', $data);
    }

    public function create()
    {
        return view('ACCOUNT MANAGER/pic/create-pic-manager');
    }

    public function store()
    {
        $picUserModel = new PicUserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'PICUser'
        ];

        $picUserModel->insert($data);

        session()->setFlashdata('success_message', 'PIC User has been created successfully.');
        session()->setFlashdata('success_type', 'created');

        return redirect()->to('ACCOUNT MANAGER/pic/pic-manager');
    }

    public function edit($id)
    {
        $picUserModel = new PicUserModel();
        $picUser = $picUserModel->find($id);

        if (!$picUser) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('PIC User not found');
        }

        return view('ACCOUNT MANAGER/pic/edit-pic-manager', ['pic_user' => $picUser]);
    }

    public function update($id)
    {
        $picUserModel = new PicUserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        // Update password hanya jika ada input
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $picUserModel->update($id, $data);

        session()->setFlashdata('success_message', 'PIC User has been updated successfully.');
        session()->setFlashdata('success_type', 'updated');

        return redirect()->to('ACCOUNT MANAGER/pic/pic-manager');
    }

    public function delete($id)
    {
        $picUserModel = new PicUserModel();
        $picUserModel->delete($id);

        session()->setFlashdata('success_message', 'PIC User has been deleted successfully.');
        session()->setFlashdata('success_type', 'deleted');

        return redirect()->to('ACCOUNT MANAGER/pic/pic-manager');
    }
}
