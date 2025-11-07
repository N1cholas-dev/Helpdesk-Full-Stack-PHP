<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nama tabel untuk User
    protected $primaryKey = 'id'; // Kunci utama
    protected $allowedFields = ['username', 'email', 'password', 'role', 'profile_picture']; // Kolom yang dapat diisi
    protected $useTimestamps = false; // Untuk otomatis mengatur created_at dan updated_at
}
