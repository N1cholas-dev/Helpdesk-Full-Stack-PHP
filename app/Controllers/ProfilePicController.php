<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PicUserModel;
use CodeIgniter\Controller;

class ProfilePicController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $picUserModel = new PicUserModel();
        $userId = $session->get('user_id');

        $data = [
            'user' => $picUserModel->find($userId), // Data PIC user yang sedang login
            'pageTitle' => 'PIC User Profile',
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error')
        ];

        return view('PROFILE PIC/profile', $data);
    }

    public function edit($id)
    {
        // Ambil data PIC user berdasarkan $id
        $picUserModel = new PicUserModel();
        $user = $picUserModel->find($id);

        // Pastikan user ada, jika tidak bisa redirect atau tampilkan error
        if (!$user) {
            return redirect()->to('profile')->with('error', 'User not found');
        }

        $data = [
            'user' => $user,
            'pageTitle' => 'Edit Profile'
        ];

        return view('PROFILE PIC/edit-profile', $data);
    }

    public function update()
    {
        $session = session();
        $picId = $session->get('user_id'); // Ambil ID PIC dari session

        // Cek apakah ada file yang di-upload
        if ($this->request->getFile('profile_picture')->isValid()) {
            $file = $this->request->getFile('profile_picture');
            $newFileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/profile_pictures', $newFileName);

            // Update data di database dengan nama file baru
            $this->picModel->update($picId, [
                'profile_picture' => $newFileName
            ]);
        }

        return redirect()->to('/profile')->with('message', 'Profile picture updated successfully!');
    }

    public function uploadProfilePicture()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'User not authenticated');
        }

        $picUserModel = new PicUserModel();
        $user = $picUserModel->find($userId);

        if (!$user) {
            return redirect()->to('/PROFILE PIC/profile')->with('error', 'User not found');
        }

        $file = $this->request->getFile('profile_picture');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile_pictures/', $newName);

            // Pastikan update hanya dilakukan jika `$userId` valid
            if ($picUserModel->update($userId, ['profile_picture' => $newName])) {
                // Perbarui session dengan gambar profil yang baru
                $session->set('profile_picture', $newName);

                // Hapus gambar lama jika ada
                if (!empty($user['profile_picture']) && file_exists('uploads/profile_pictures/' . $user['profile_picture'])) {
                    unlink('uploads/profile_pictures/' . $user['profile_picture']);
                }

                return redirect()->to('/PROFILE PIC/profile')->with('success', 'Profile picture updated successfully');
            } else {
                return redirect()->to('/PROFILE PIC/profile')->with('error', 'Failed to update profile picture');
            }
        }

        return redirect()->to('/PROFILE PIC/profile')->with('error', 'Invalid file upload');
    }

}
