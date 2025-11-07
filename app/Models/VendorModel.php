<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table = 'vendors';  // Tabel vendor
    protected $primaryKey = 'id';  // Primary key tabel vendor
    protected $allowedFields = ['name'];  // Kolom yang boleh diisi
}
