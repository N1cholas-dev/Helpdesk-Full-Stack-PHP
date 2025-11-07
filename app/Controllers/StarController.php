<?php

namespace App\Controllers;

use App\Models\TicketFeedbackModel;
use App\Models\HelpdeskTicketModel;
use CodeIgniter\Controller;

class StarController extends BaseController
{
    protected $feedbackModel;
    protected $ticketModel;

    public function __construct()
    {
        $this->feedbackModel = new TicketFeedbackModel();
        $this->ticketModel = new HelpdeskTicketModel();
    }

    // Menampilkan halaman rating
    public function index()
    {
        return view('ACCOUNT MANAGER/rating/star');
    }

    // Menghitung rata-rata rating per PIC
    public function averagePerPic()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT p.name AS pic_name, AVG(tf.rating) AS avg_rating
            FROM ticket_feedback tf
            JOIN helpdesk_tickets ht ON tf.ticket_id = ht.id
            JOIN pics p ON ht.pic_id = p.id
            GROUP BY p.id, p.name
        ");

        $results = $query->getResultArray();

        return $this->response->setJSON($results);
    }

    // Menghitung rata-rata waktu penyelesaian per PIC
    public function averageTimePerPic()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
        SELECT p.name AS pic_name, 
               AVG(TIMESTAMPDIFF(HOUR, ht.ticket_date, ht.end_date)) AS avg_time
        FROM helpdesk_tickets ht
        JOIN pics p ON ht.pic_id = p.id
        WHERE ht.ticket_date IS NOT NULL AND ht.end_date IS NOT NULL
        GROUP BY p.id, p.name
    ");

        $results = $query->getResultArray();

        return $this->response->setJSON($results);
    }

}
