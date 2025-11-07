<?php

namespace App\Controllers;

use App\Models\HelpdeskTicketModel;
use App\Models\TicketFeedbackModel;
use CodeIgniter\Controller;

class AchievementController extends BaseController
{
    protected $helpdeskTicketModel;
    protected $ticketFeedbackModel;

    public function __construct()
    {
        $this->helpdeskTicketModel = new HelpdeskTicketModel();
        $this->ticketFeedbackModel = new TicketFeedbackModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // === 1. PIC dengan tiket terbanyak ===
        $builderPic = $db->table('helpdesk_tickets ht');
        $builderPic->select('p.name AS name, COUNT(*) AS total_tickets');
        $builderPic->join('pics p', 'p.id = ht.pic_id');
        $builderPic->groupBy('ht.pic_id');
        $builderPic->orderBy('total_tickets', 'DESC');
        $topPICs = $builderPic->get(5)->getResultArray();

        // === 2. User dengan tiket terbanyak ===
        $builderUser = $db->table('helpdesk_tickets ht');
        $builderUser->select('u.username AS name, COUNT(*) AS total_tickets');
        $builderUser->join('users u', 'u.id = ht.user_id');
        $builderUser->groupBy('ht.user_id');
        $builderUser->orderBy('total_tickets', 'DESC');
        $topUsers = $builderUser->get(5)->getResultArray();

        // === 3. Admin total tiket yang diajukan (total seluruh tiket) ===
        $adminStat = [
            'name' => 'Admin',
            'total_tickets' => $this->helpdeskTicketModel->countAllResults()
        ];

        return view('ACCOUNT MANAGER/reward/achievement', [
            'topPICs' => $topPICs,
            'topUsers' => $topUsers,
            'adminStat' => $adminStat
        ]);
    }

    public function getAchievementData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ticket_feedback tf');
        $builder->select('pics.name AS pic_name, ROUND(AVG(tf.rating), 2) AS avg_rating, COUNT(tf.rating) as total_rating');
        $builder->join('helpdesk_tickets ht', 'ht.id = tf.ticket_id');
        $builder->join('pics', 'pics.id = ht.pic_id'); // Ganti dari users ke pics
        $builder->groupBy('ht.pic_id');

        $query = $builder->get()->getResultArray();

        return $this->response->setJSON($query);
    }

}