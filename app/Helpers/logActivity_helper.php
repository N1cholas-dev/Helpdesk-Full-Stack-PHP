<?php

use CodeIgniter\I18n\Time;

if (!function_exists('logActivity')) {
    function logActivity($action, $details = '', $url = null)
    {
        $session = session();

        $userId = $session->get('user_id');
        $role   = $session->get('role');
        $url    = $url ?? current_url();

        // Jika tidak ada user_id di session, jangan catat
        if (!$userId || !$role) {
            return;
        }

        $db = \Config\Database::connect();
        $builder = $db->table('activity_logs');

        $builder->insert([
            'user_id'      => $userId,
            'role'         => $role,
            'action'       => $action,
            'details'      => $details,
            'url_accessed' => $url,
            'created_at'   => Time::now('Asia/Jakarta', 'en_US')
        ]);
    }
}
