<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ProfileUserController extends Controller
{
    public function user()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');

        // Mengambil data user yang sedang login
        $data = [
            'user' => $userModel->find($userId), // Hanya menampilkan data user yang sedang login
            'pageTitle' => 'User Profile'
        ];

        return view('PROFILE USER/profile', $data);
    }

    public function uploadProfilePicture()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'User not authenticated');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/PROFILE USER/profile')->with('error', 'User not found');
        }

        $file = $this->request->getFile('profile_picture');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile_pictures/', $newName);

            if ($userModel->update($userId, ['profile_picture' => $newName])) {
                // Perbarui session
                $session->set('profile_picture', $newName);

                // Hapus gambar lama jika ada
                if (!empty($user['profile_picture']) && file_exists('uploads/profile_pictures/' . $user['profile_picture'])) {
                    unlink('uploads/profile_pictures/' . $user['profile_picture']);
                }

                return redirect()->to('/PROFILE USER/profile')->with('success', 'Gambar profil berhasil diperbarui.');
            } else {
                return redirect()->to('/PROFILE USER/profile')->with('error', 'Gagal memperbarui data profil.');
            }
        }

        return redirect()->to('/PROFILE USER/profile')->with('error', 'Unggahan gambar tidak valid.');
    }

    public function edit()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');
        $data['user'] = $userModel->find($userId);

        return view('PROFILE USER/edit-profile', $data);
    }

    public function updateuser()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userId = $session->get('user_id');

        $input = $this->request->getPost();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'role' => 'required|in_list[admin,user]',
        ]);

        if (!$validation->run($input)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel->update($userId, [
            'username' => $input['username'],
            'email' => $input['email'],
            'role' => $input['role'],
        ]);

        return redirect()->to(route_to('PROFILE USER/profile'))->with('success', 'Profile updated successfully');
    }
}
