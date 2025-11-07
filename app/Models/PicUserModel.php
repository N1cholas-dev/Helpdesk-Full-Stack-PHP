<?php

namespace App\Models;

use CodeIgniter\Model;

class PicUserModel extends Model
{
    protected $table = 'pic_user'; // Nama tabel untuk PIC User
    protected $primaryKey = 'id'; // Kunci utama
    protected $allowedFields = ['username', 'email', 'password', 'role', 'created_at', 'updated_at', 'profile_picture']; // Kolom yang dapat diisi
    protected $useTimestamps = true; // Otomatis mengatur created_at dan updated_at
}
