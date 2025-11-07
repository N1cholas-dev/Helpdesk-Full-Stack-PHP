<?php

namespace App\Models;

use CodeIgniter\Model;

class IssueOwnerModel extends Model
{
    protected $table = 'issue_owners';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
}
