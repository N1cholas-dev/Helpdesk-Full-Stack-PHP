<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PicUserModel;
use App\Models\CategoryModel;
use App\Models\AdminModel;

class UserManagerController extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $picModel = new PicUserModel();
        $userModel = new UserModel();

        return view('ACCOUNT MANAGER/user/user-manager', [
            'admins' => $adminModel->getAdmins(),
            'picUsers' => $picModel->findAll(),
            'users' => $userModel->findAll(),
        ]);
    }

    public function create()
    {
        return view('ACCOUNT MANAGER/user/create');
    }

    public function store()
    {
        $userModel = new UserModel();
        $requestByModel = new \App\Models\RequestByModel();
        $issueOwnerModel = new \App\Models\IssueOwnerModel();

        $username = $this->request->getPost('username');

        $data = [
            'username' => $username,
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        if ($userModel->insert($data)) {

            // Insert otomatis ke Request By
            $requestByModel->insert([
                'name' => $username
            ]);

            // Insert otomatis ke Issue Owner
            $issueOwnerModel->insert([
                'name' => $username
            ]);

            session()->setFlashdata('success', 'User has been created successfully and added to Request By & Issue Owner.');
        } else {
            session()->setFlashdata('error', 'Failed to create user.');
        }

        return redirect()->to('ACCOUNT MANAGER/user/user-manager');
    }

    public function edituser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        return view('ACCOUNT MANAGER/user/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        if ($userModel->update($id, $data)) {
            session()->setFlashdata('success', 'User has been updated successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to update user.');
        }

        return redirect()->to('ACCOUNT MANAGER/user/user-manager');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        if ($userModel->delete($id)) {
            session()->setFlashdata('success', 'User has been deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to delete user.');
        }

        return redirect()->to('ACCOUNT MANAGER/user/user-manager');
    }
}
