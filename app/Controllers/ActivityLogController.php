<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;

class ActivityLogController extends BaseController
{
    protected $activityLogModel;

    public function __construct()
    {
        // Pastikan helper 'logActivity' sudah dimuat
        helper('logActivity');

        // Cek apakah session 'history_accessed' sudah ada
        if (!session()->get('history_accessed')) {
            // Log aktivitas hanya saat membuka halaman utama history pertama kali
            logActivity('NAVIGATE', 'Accessed activity history page', current_url());

            // Tandai bahwa halaman history sudah diakses
            session()->set('history_accessed', true);
        }

        // Inisialisasi model
        $this->activityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        // Ambil URL saat ini
        $currentUrl = current_url();

        // Ambil waktu saat ini (untuk mencegah pencatatan aktivitas terlalu sering dalam waktu singkat)
        $currentTime = time();

        // Cek apakah URL saat ini sudah tercatat sebelumnya dalam sesi
        $lastLoggedUrl = session()->get('last_logged_url');
        $lastLoggedTime = session()->get('last_logged_time');

        // Hanya log aktivitas jika URL saat ini berbeda, atau jika sudah lebih dari 5 detik sejak terakhir kali log
        if ($currentUrl !== $lastLoggedUrl || ($currentTime - $lastLoggedTime) > 5) {
            // Log aktivitas hanya jika URL berbeda atau sudah lebih dari 5 detik
            logActivity('NAVIGATE', 'Accessed page: ' . $currentUrl, $currentUrl);
            session()->set('last_logged_url', $currentUrl); // Simpan URL terakhir yang diakses dalam sesi
            session()->set('last_logged_time', $currentTime); // Simpan waktu terakhir log dalam sesi
        }

        // Hapus log yang lebih lama dari 10 menit
        $this->deleteOldLogs();

        // Menampilkan halaman history
        return view('ACCOUNT MANAGER/activity/history');
    }

    public function fetch()
    {
        // Ambil semua log, tanpa filter dulu (untuk tes awal)
        $logs = $this->activityLogModel
            ->orderBy('created_at', 'DESC')
            ->findAll(); // tanpa filter

        // Debug: Cek apakah $logs kosong
        if (empty($logs)) {
            return $this->response->setJSON(['data' => []]);
        }

        $data = [];
        foreach ($logs as $log) {
            $data[] = [
                'created_at' => date('d-m-Y H:i:s', strtotime($log['created_at'])),
                'user_id' => $log['user_id'],
                'role' => $log['role'],
                'action' => $log['action'],
                'details' => $log['details'],
                'url_accessed' => $log['url_accessed'],
                'id' => $log['id']  // Pastikan id juga disertakan
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    // Fungsi untuk menghapus log yang lebih lama dari waktu tertentu
    private function deleteOldLogs()
    {
        // Tentukan batas waktu (misalnya 10 menit yang lalu)
        $timeLimit = date('Y-m-d H:i:s', strtotime('-10 minutes'));

        // Panggil fungsi deleteOldLogs di model untuk menghapus log yang lebih lama dari waktu tersebut
        $this->activityLogModel->deleteOldLogs($timeLimit);
    }

    public function autoDeleteOldLogs()
    {
        $model = new ActivityLogModel();

        // Ambil 20 data terbaru
        $latestLogs = $model->orderBy('id', 'DESC')->limit(10)->find();

        if (!empty($latestLogs)) {
            $idsToDelete = array_column($latestLogs, 'id');
            $model->whereIn('id', $idsToDelete)->delete();
        }

        return $this->response->setJSON(['status' => 'success', 'deleted' => count($latestLogs)]);
    }

}

