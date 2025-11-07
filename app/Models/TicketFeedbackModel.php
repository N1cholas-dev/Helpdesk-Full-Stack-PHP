<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketFeedbackModel extends Model
{
    protected $table = 'ticket_feedback'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key

    protected $allowedFields = [
        'ticket_id',
        'user_id',
        'rating',
        'comment',
        'created_at'
    ];

    /**
     * Mengambil feedback berdasarkan ticket_id
     *
     * @param int $ticketId
     * @return array|null
     */
    public function getFeedbackByTicket($ticketId)
    {
        return $this->where('ticket_id', $ticketId)->first() ?? null;
    }

    /**
     * Mengambil rata-rata rating dari semua feedback
     *
     * @return float|null
     */
    public function getAverageRating()
    {
        $result = $this->selectAvg('rating')->get()->getRow();
        return $result ? $result->rating : null;
    }
}
