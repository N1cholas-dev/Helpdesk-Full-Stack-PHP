<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $allowedFields = ['description'];
    protected $useTimestamps = true; // ✅ Aktifkan timestamps
}
