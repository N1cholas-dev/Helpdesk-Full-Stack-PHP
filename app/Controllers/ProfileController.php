<?php
namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $adminModel = new AdminModel();
        $adminId = $session->get('admin_id');

        // Mengambil data admin yang sedang login
        $data = [
            'admin' => $adminModel->find($adminId), // Hanya menampilkan data admin yang sedang login
            'pageTitle' => 'Admin Profile'
        ];

        return view('PROFILE ADMIN/profile', $data);
    }

    public function uploadProfilePicture()
    {
        $adminId = session()->get('user_id'); // Ambil ID admin yang sedang login
        if (!$adminId) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }

        $adminModel = new AdminModel();

        // Validasi gambar
        if (
            !$this->validate([
                'profile_picture' => [
                    'rules' => 'uploaded[profile_picture]|max_size[profile_picture,2048]|is_image[profile_picture]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Harap unggah gambar.',
                        'max_size' => 'Ukuran gambar maksimal 2MB.',
                        'is_image' => 'File harus berupa gambar.',
                        'mime_in' => 'Format gambar hanya jpg, jpeg, atau png.',
                    ]
                ]
            ])
        ) {
            return redirect()->back()->with('error', $this->validator->getErrors());
        }

        // Ambil file yang diunggah
        $file = $this->request->getFile('profile_picture');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $adminId . '_' . time() . '.' . $file->getExtension(); // Nama file unik per admin
            $file->move('uploads/profile_pictures/', $newName); // Simpan gambar ke folder

            // Ambil data admin sebelum update
            $adminData = $adminModel->find($adminId);

            if ($adminData && $adminData['profile_picture'] !== $newName) {
                $adminModel->update($adminId, ['profile_picture' => $newName]);

                // Update session agar sidebar langsung berubah
                session()->set('profile_picture', $newName);
            }

            return redirect()->back()->with('success', 'Gambar profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

}