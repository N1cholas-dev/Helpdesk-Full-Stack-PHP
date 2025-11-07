<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeHistoryModel extends Model
{
    protected $table = 'employee_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employee_id', 'name', 'email', 'department', 'role',
        'date_of_joining', 'action', 'action_date'
    ];
}
