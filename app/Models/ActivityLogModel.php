<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'role', 'action', 'details', 'url_accessed', 'created_at'];

    // Fungsi untuk menghapus log yang lebih lama dari waktu tertentu (dalam menit)
    public function deleteOldLogs($minutes)
    {
        // Menghitung batas waktu yang lebih lama dari X menit
        $threshold = date('Y-m-d H:i:s', strtotime("-$minutes minutes"));

        // Menghapus data yang lebih lama dari threshold
        return $this->where('created_at <', $threshold)
            ->delete();
    }

    // Fungsi untuk mendapatkan semua log dengan filter opsional
    public function getAllLogs($filters = [])
    {
        $builder = $this->builder();

        if (!empty($filters['role'])) {
            $builder->where('role', $filters['role']);
        }

        if (!empty($filters['action'])) {
            $builder->where('action', $filters['action']);
        }

        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $builder->where("created_at BETWEEN '{$filters['start_date']}' AND '{$filters['end_date']}'");
        }

        return $builder->orderBy('created_at', 'DESC')->get()->getResult();
    }
}
