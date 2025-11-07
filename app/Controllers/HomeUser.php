<?php

// app/Controllers/Home.php

namespace App\Controllers;

use App\Models\HelpdeskTicketModel;
use App\Models\PicModel;

class Home extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $ticketModel = new HelpdeskTicketModel();
        $picModel = new PicModel();

        // Mengambil semua data tiket
        $tickets = $ticketModel->findAll();

        // Menghitung jumlah tiket per status
        $ticketsByStatus = $ticketModel->select('status, COUNT(id) as ticket_count')
                                       ->groupBy('status')
                                       ->findAll();

        // Mengambil data tiket berdasarkan PIC dengan nama PIC
        $ticketsByPic = $ticketModel->select('helpdesk_tickets.pic_id, COUNT(helpdesk_tickets.id) as ticket_count, IFNULL(pics.name, "Unknown") as pic_name')
                                    ->join('pics', 'helpdesk_tickets.pic_id = pics.id', 'left') // Menggunakan LEFT JOIN
                                    ->groupBy('helpdesk_tickets.pic_id')
                                    ->findAll();

        // Mengambil data PIC
        $pics = $picModel->findAll();

        // Mengirimkan data ke view
        return view('user', [
            'tickets' => $tickets,              // Data tiket
            'ticketsByStatus' => $ticketsByStatus,  // Data untuk bar chart berdasarkan status
            'ticketsByPic' => $ticketsByPic,        // Data untuk doughnut chart berdasarkan PIC
            'pics' => $pics                        // Data PIC (misalnya nama PIC)
        ]);
    }
}
