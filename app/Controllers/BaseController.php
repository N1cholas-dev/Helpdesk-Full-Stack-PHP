<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Panggil autoLogActivity untuk mencatat setiap akses
        $this->autoLogActivity();
    }

    protected function autoLogActivity()
    {
        $method = $this->request->getMethod(true);
        $uri = current_url();
        $session = session();

        // Skip jika AJAX, fetch, get data, atau notifikasi
        if (
            str_contains($uri, '/fetch') ||
            str_contains($uri, '/get') ||
            str_contains($uri, '/notifications') ||
            $this->request->isAJAX()
        ) {
            return;
        }

        // Skip jika redirect setelah POST
        if ($session->get('skip_next_navigation_log')) {
            $session->remove('skip_next_navigation_log');
            return;
        }

        // Tangani POST khusus update helpdesk
        if ($method === 'POST' && preg_match('/\/helpdesk\/update\/\d+/', $uri)) {
            $description = "Updated ticket on helpdesk";
            logActivity('UPDATE', $description, $uri);

            // Hindari log NAVIGATE setelah redirect dari update
            $session->set('skip_next_navigation_log', true);
            return;
        }

        // Skip GET ke update (biasanya redirect atau reload form)
        if ($method === 'GET' && preg_match('/\/helpdesk\/update\/\d+/', $uri)) {
            return;
        }

        // Tangani POST lain (misal create, edit, dsb)
        if ($method === 'POST') {
            $description = "Accessed page: $uri";
            if (str_contains($uri, 'edit')) {
                $description = "Accessed helpdesk edit page";
            } else if (str_contains($uri, 'update')) {
                $description = "Accessed helpdesk update page";
            }
            logActivity('NAVIGATE', $description, $uri);
            return;
        }

        // Untuk GET normal (navigasi)
        $currentTime = time();
        $ipAddress = $this->request->getIPAddress();
        $userAgent = $this->request->getUserAgent();
        $uniqueKey = md5($uri . $ipAddress . $userAgent);

        $lastKey = $session->get('last_logged_key');
        $lastTime = intval($session->get('last_logged_time'));

        // Cek daftar yang sudah pernah dicatat
        $loggedPages = $session->get('logged_pages') ?? [];

        // Skip jika halaman ini sudah dicatat dalam 5 detik terakhir
        if (in_array($uniqueKey, $loggedPages) && ($currentTime - $lastTime) < 5) {
            return;
        }

        // Buat deskripsi berdasarkan URI
        $description = "Accessed page: $uri";
        if (str_contains($uri, 'helpdesk')) {
            $description = "Accessed helpdesk page";
        } else if (str_contains($uri, 'history')) {
            $description = "Accessed activity history page";
        } else if (str_contains($uri, 'employee')) {
            $description = "Accessed employee page";
        }

        logActivity('NAVIGATE', $description, $uri);

        // Update sesi log
        $session->set('last_logged_time', $currentTime);
        $session->set('last_logged_key', $uniqueKey);

        // Tambahkan ke daftar halaman yang sudah dicatat
        $loggedPages[] = $uniqueKey;
        $session->set('logged_pages', $loggedPages);
    }

}

