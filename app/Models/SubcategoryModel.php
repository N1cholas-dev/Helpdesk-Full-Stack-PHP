<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoryModel extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'category_id'];
}
