<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;

class DownloadController extends Controller
{
    public function download($fileName)
    {
        $filePath = WRITEPATH . 'uploads/tickets/' . urldecode($fileName); // Dekode nama file

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
