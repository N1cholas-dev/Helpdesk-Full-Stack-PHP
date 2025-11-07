<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Models\HelpdeskTicketModel;
use CodeIgniter\API\ResponseTrait;

class NotificationController extends BaseController
{
    use ResponseTrait;

    protected $notificationModel;
    protected $ticketModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->ticketModel = new HelpdeskTicketModel();
    }

    public function getNotifications()
    {
        $session = session();

        if (!$session->has('admin_id')) {
            log_message('error', 'Admin ID not found in session');
            return $this->response->setJSON([
                'status' => 403,
                'error' => 403,
                'messages' => ['error' => 'Admin not logged in']
            ])->setStatusCode(403);
        }

        $adminId = $session->get('admin_id');
        log_message('debug', 'Admin ID in session: ' . $adminId);

        $notifications = $this->notificationModel->where('admin_id', $adminId)->findAll();

        return $this->response->setJSON([
            'status' => 200,
            'notifications' => $notifications
        ]);
    }

    public function create()
    {
        $data = [
            'subject' => $this->request->getPost('subject'),
            'problem' => $this->request->getPost('problem'),
            // Tambah field lain sesuai kebutuhan
        ];

        if ($this->ticketModel->insert($data)) {
            $ticketId = $this->ticketModel->insertID();
            $username = session()->get('username') ?? 'System';

            $this->notificationModel->addNotification("Ticket #{$ticketId} berhasil dibuat oleh {$username}");

            return redirect()->back()->with('success', 'Ticket berhasil dibuat.');
        }

        return redirect()->back()->with('error', 'Gagal membuat ticket.');
    }

    public function delete($id)
    {
        if ($this->ticketModel->delete($id)) {
            $username = session()->get('username') ?? 'System';

            $this->notificationModel->addNotification("Ticket #{$id} telah dihapus oleh {$username}");

            return redirect()->back()->with('success', 'Ticket berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus ticket.');
    }

    public function markAllAsRead()
    {
        $adminId = session()->get('admin_id');

        if (!$adminId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin not logged in'])->setStatusCode(403);
        }

        $this->notificationModel->where('admin_id', $adminId)->set(['status' => 'read'])->update();

        return $this->response->setJSON(['success' => true]);
    }

    public function fetchNotifications()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('Invalid request');
        }

        $adminId = session()->get('admin_id');
        if (!$adminId) {
            return $this->failUnauthorized('Admin not logged in');
        }

        $notifications = $this->notificationModel->getNotifications($adminId);
        $unreadCount = count($notifications);

        return $this->respond([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }
}
