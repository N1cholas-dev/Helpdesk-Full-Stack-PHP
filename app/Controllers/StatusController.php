<?php

namespace App\Controllers;

use App\Models\PicModel;
use App\Models\PicUserModel;
use App\Models\HelpdeskTicketModel;
use CodeIgniter\Controller;

class StatusController extends BaseController
{
    public function index()
    {
        $picUserModel = new PicUserModel();
        $ticketModel = new HelpdeskTicketModel();
        $picModel = new PicModel();  // Model untuk tabel pics

        // Ambil semua data dari tabel pic_user
        $picUsers = $picUserModel->findAll();

        $totalTickets = [];
        $avgResolutionTime = [];
        $tickets = [];

        foreach ($picUsers as $index => $picUser) {
            $picId = $picUser['id'];

            // Ambil nama dari tabel pics berdasarkan id yang ada di pic_user
            $pic = $picModel->where('id', $picUser['id'])->first();  // Menggunakan 'id' dari pic_user

            // Siapkan profile_picture dan role dari pic_user
            $profilePicture = 'dist/img/avatar5.png';
            if (!empty($picUser['profile_picture']) && file_exists(FCPATH . 'uploads/profile_pictures/' . $picUser['profile_picture'])) {
                $profilePicture = 'uploads/profile_pictures/' . $picUser['profile_picture'];
            }

            // Simpan ke array untuk dikirim ke view
            $picUsers[$index]['profile_picture'] = $profilePicture;
            $picUsers[$index]['role'] = $picUser['role'] ?? 'Role Tidak Ditemukan';
            $picUsers[$index]['name'] = $pic ? $pic['name'] : 'Nama Tidak Ditemukan'; // Ambil nama dari tabel pics

            // Hitung jumlah tiket yang ditangani oleh PIC ini
            $totalTickets[$picId] = $ticketModel->where('pic_id', $picId)->countAllResults();

            // Hitung rata-rata waktu penyelesaian tiket
            $query = $ticketModel->select('TIMESTAMPDIFF(HOUR, ticket_date, end_date) as resolution_hours')
                ->where('pic_id', $picId)
                ->where('end_date IS NOT NULL')
                ->findAll();

            $totalTime = 0;
            $count = count($query);
            foreach ($query as $row) {
                $totalTime += (int) $row['resolution_hours'];
            }
            $avgResolutionTime[$picId] = $count > 0 ? round($totalTime / $count, 2) : 0;

            // Simpan tiket berdasarkan PIC ID
            $tickets[$picId] = $ticketModel->select('id, ticket_date, end_date, status')
                ->where('pic_id', $picId)
                ->findAll();
        }

        // Kirim data ke view
        return view('ACCOUNT MANAGER/about/status', [
            'pics' => $picUsers,
            'total_tickets' => $totalTickets,
            'avg_resolution_time' => $avgResolutionTime,
            'tickets' => $tickets
        ]);
    }
}
