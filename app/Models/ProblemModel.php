<?php

namespace App\Models;

use CodeIgniter\Model;

class ProblemModel extends Model
{
    protected $table = 'problems';
    protected $allowedFields = ['description'];
    protected $useTimestamps = true; // ✅ Aktifkan timestamps
}
