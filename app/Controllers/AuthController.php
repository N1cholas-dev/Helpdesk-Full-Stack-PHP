<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\PicUserModel; // Tambahkan model PICUSER

class AuthController extends BaseController
{
    public function welcome()
    {
        return view('auth/welcome');
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectBasedOnRole();
        }

        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            return redirect()->back()->with('error', 'Email dan password wajib diisi!');
        }

        $userModel = new UserModel();
        $adminModel = new AdminModel();
        $picUserModel = new PicUserModel(); // Tambahkan model PICUSER

        // Cek apakah email ada di tabel admin
        $admin = $adminModel->where('email', $email)->first();
        if ($admin && password_verify($password, $admin['password'])) {
            $this->setUserSession($admin, 'ADMIN');
            session()->setFlashdata('success', 'Login berhasil! Selamat datang ' . $admin['username']);
            return redirect()->to('DOCUMENTATION IT/dashboard/home'); // Sesuaikan dengan route admin
        }

        // Jika bukan admin, cek di tabel user
        $user = $userModel->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $role = strtoupper($user['role']); // Pastikan role selalu huruf besar
            $this->setUserSession($user, $role);
            session()->setFlashdata('success', 'Login berhasil! Selamat datang ' . $user['username']);
            return $this->redirectBasedOnRole();
        }

        // Jika bukan user biasa, cek di tabel PICUSER
        $picUser = $picUserModel->where('email', $email)->first();
        if ($picUser && password_verify($password, $picUser['password'])) {
            $this->setUserSession($picUser, 'PICUser');
            session()->setFlashdata('success', 'Login berhasil! Selamat datang ' . $picUser['username']);
            return redirect()->to('PROGRESS TRACK/dashboard/home'); // Sesuaikan dengan route PIC User
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function register()
    {
        return view('AUTH/register');
    }

    public function processRegister()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'USER'
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
    }

    public function forgotPassword()
    {
        return view('AUTH/forgot-password');
    }

    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        // Simpan token reset password (sederhana, bisa menggunakan UUID)
        $token = bin2hex(random_bytes(32));
        $userModel->update($user['id'], ['reset_token' => $token]);

        return redirect()->to('/login')->with('success', 'Password reset link sent to your email.');
    }

    private function setUserSession($user, $role)
{
    session()->set([
        'session_id' => session_id(),
        'isLoggedIn' => true,
        'email' => $user['email'],
        'user_id' => $user['id'],
        'role' => $role,
        'name' => $user['username'],
        'profile_picture' => $user['profile_picture'] ?? 'default.png', // Jika tidak ada, gunakan default
    ]);
    
    // Jika yang login adalah admin, simpan juga admin_id
    if ($role === 'ADMIN') {
        session()->set('admin_id', $user['id']);
    }
}    

    private function redirectBasedOnRole()
    {
        $role = session()->get('role') ?? 'USER'; // Default ke USER jika tidak ada role
        $roleRoutes = [
            'ADMIN' => 'DOCUMENTATION IT/dashboard/home',
            'USER' => 'USER/helpdesk/helpdesk-user',
            'PICUser' => 'PROGRESS TRACK/dashboard/home'
        ];

        return redirect()->to($roleRoutes[$role] ?? 'DOCUMENTATION IT/dashboard/home');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
