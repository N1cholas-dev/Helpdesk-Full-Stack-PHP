<?php

namespace App\Controllers;

use App\Models\HelpdeskTicketModel;
use CodeIgniter\Controller;

class TrackingController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new HelpdeskTicketModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tracking Tiket',
            'tickets' => $this->ticketModel->getTrackingTickets()
        ];

        return view('ACCOUNT MANAGER/progress/tracking', $data);
    }

}
