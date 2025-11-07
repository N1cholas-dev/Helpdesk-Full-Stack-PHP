<?php

namespace App\Controllers;
class Notification extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Ticket_model'); // Model untuk mengakses tiket
    }

    // Ambil notifikasi terbaru
    public function get_notifications() {
        $user_id = $this->session->userdata('user_id'); // Misalnya menggunakan session untuk user
        $notifications = $this->Ticket_model->get_notifications($user_id);
        echo json_encode($notifications);
    }
}
