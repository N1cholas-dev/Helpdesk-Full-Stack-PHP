<?php

namespace App\Models;

use CodeIgniter\Model;

class PicModel extends Model
{
    protected $table = 'pics'; // Nama tabel PIC
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['id', 'name', 'category_id', 'status', 'employee_id']; // Kolom yang dapat diubah

    public function getInactivePics($searchTerm = '')
    {
        $builder = $this->where('status', 'Non-Active'); // Filter status non-aktif

        if ($searchTerm) {
            $builder->like('name', $searchTerm)
                    ->orLike('category_id', $searchTerm); // Cari berdasarkan nama atau kategori
        }

        return $builder->findAll();
    }
}
