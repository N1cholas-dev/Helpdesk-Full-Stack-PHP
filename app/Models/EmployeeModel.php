<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';  // Nama tabel di database
    protected $primaryKey = 'id';        // Nama kolom primary key
    protected $returnType = 'array';  // Format data yang dikembalikan
    protected $useSoftDeletes = false;     // Soft delete (opsional)
    protected $allowedFields = [
        'name',
        'email',
        'department',
        'role',
        'date_of_joining',
        'status'
    ];

    protected $useTimestamps = false;  // Jika menggunakan kolom created_at dan updated_at

    public function groups()
    {
        return $this->belongsToMany(GroupModel::class, 'group_employee', 'employee_id', 'group_id');
    }

}
