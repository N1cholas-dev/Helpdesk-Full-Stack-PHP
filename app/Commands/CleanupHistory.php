<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\ActivityLogModel;

class CleanupHistory extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'history:cleanup';
    protected $description = 'Hapus log history terbaru setiap 10 detik';

    public function run(array $params)
    {
        $model = new ActivityLogModel();

        // Contoh: Hapus semua log dalam 1 menit terakhir
        $thresholdTime = date('Y-m-d H:i:s', strtotime('-10 seconds'));
        $model->where('created_at >=', $thresholdTime)->delete();

        CLI::write('Log terbaru berhasil dihapus.', 'green');
    }
}
