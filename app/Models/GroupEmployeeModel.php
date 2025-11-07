<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupEmployeeModel extends Model
{
    protected $table = 'group_employees'; // Nama tabel penghubung antara grup dan karyawan
    protected $primaryKey = 'id'; // Kunci utama
    protected $allowedFields = ['group_id', 'employee_id']; // Kolom yang dapat diisi
    protected $useTimestamps = false; // Tidak menggunakan timestamp secara otomatis, karena tidak perlu
}
