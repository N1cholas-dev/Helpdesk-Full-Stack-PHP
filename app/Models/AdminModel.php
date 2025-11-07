<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel yang digunakan
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'profile_picture'];
    protected $useTimestamps = false;

    // Method untuk mendapatkan semua admin (role = SUPERADMIN)
    public function getAdmins()
    {
        return $this->where('role', 'ADMIN')->findAll();
    }
}
