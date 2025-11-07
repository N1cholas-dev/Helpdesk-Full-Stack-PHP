<?php

namespace App\Models;

use CodeIgniter\Model;

class HelpdeskTicketModel extends Model
{
    protected $table = 'helpdesk_tickets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'ticket_date',
        'end_date',
        'resolution_time',
        'priority',
        'subject_id',
        'status',
        'pic_id',
        'request_by_id',
        'issue_owner_id',
        'category_id',
        'subcategory_id',
        'department_id',
        'problem_id'
    ];

    public function getAllTickets()
    {
        return $this->select('helpdesk_tickets.*, tf.rating, tf.comment')
            ->join('ticket_feedback tf', 'tf.ticket_id = helpdesk_tickets.id', 'left')
            ->findAll();
    }

    public function getTicketsByStatus()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT s.status_name, COALESCE(COUNT(t.id), 0) AS ticket_count
            FROM (
                SELECT 'Open' AS status_name
                UNION SELECT 'Closed'
                UNION SELECT 'Reject by IT'
                UNION SELECT 'Done'
            ) AS s
            LEFT JOIN helpdesk_tickets t ON s.status_name = t.status
            GROUP BY s.status_name
            ORDER BY ticket_count DESC
        ");

        return $query->getResultArray();
    }

    public function getTrackingTickets()
    {
        return $this->select('helpdesk_tickets.*, subjects.description AS subject_name')
            ->join('subjects', 'subjects.id = helpdesk_tickets.subject_id', 'left')
            ->orderBy('helpdesk_tickets.id', 'ASC') // Urut berdasarkan ID secara naik
            ->findAll();
    }


}
