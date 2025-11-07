<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['admin_id', 'message', 'status', 'created_at'];

    // Ambil notifikasi berdasarkan admin_id dan status belum dibaca
    public function getNotifications($admin_id)
    {
        return $this->where('admin_id', $admin_id)
            ->where('status', 'unread')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // Ambil semua notifikasi (baik yang sudah dibaca atau belum)
    public function getAllNotifications($admin_id)
    {
        return $this->where('admin_id', $admin_id)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // Tambahkan notifikasi baru untuk admin
    public function addNotification($message, $type = 'update', $ticketId = null, $adminId = 1)
    {
        return $this->save([
            'admin_id' => $adminId,
            'message' => $message,
            'type' => $type,
            'ticket_id' => $ticketId,
            'status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Tandai semua notifikasi sebagai sudah dibaca berdasarkan admin_id
    public function markAsRead($admin_id)
    {
        return $this->where('admin_id', $admin_id)
            ->where('status', 'unread') // Pastikan hanya mengupdate yang 'unread'
            ->set('status', 'read')
            ->update();
    }
}
