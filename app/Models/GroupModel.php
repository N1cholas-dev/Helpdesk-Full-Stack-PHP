<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'groups'; // Nama tabel untuk Group
    protected $primaryKey = 'id'; // Kunci utama
    protected $allowedFields = ['group_name', 'description', 'created_at', 'updated_at']; // Kolom yang dapat diisi
    protected $useTimestamps = true; // Untuk otomatis mengatur created_at dan updated_at

    // Definisikan relasi many-to-many dengan Employee
    public function employees()
    {
        return $this->belongsToMany(EmployeeModel::class, 'group_employee', 'group_id', 'employee_id');
    }

    public function getGroupEmployees($groupId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('group_employees'); // Tabel yang menyimpan hubungan grup dan anggota
        $builder->select('employee_id');
        $builder->where('group_id', $groupId);
        $query = $builder->get();

        return $query->getResultArray(); // Mengembalikan hasil query dalam bentuk array
    }
}
