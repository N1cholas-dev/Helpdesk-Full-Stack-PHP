<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestByModel extends Model
{
    protected $table = 'request_by';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}
