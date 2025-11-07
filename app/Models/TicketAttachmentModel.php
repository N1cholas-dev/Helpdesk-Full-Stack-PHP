<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketAttachmentModel extends Model
{
    protected $table = 'ticket_attachments';
    protected $primaryKey = 'attachment_id';
    protected $allowedFields = ['ticket_id', 'file_name', 'file_path', 'created_at'];

    // Fungsi untuk mengupload file lampiran
    public function uploadAttachment($ticketId)
    {
        $files = request()->getFileMultiple('attachment');
        $maxSize = 10240 * 1024; // 10MB dalam byte
        $allowedTypes = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/zip',
            'application/x-rar-compressed',
            'application/x-7z-compressed'
        ];

        foreach ($files as $file) {
            // Validasi file
            if ($file->isValid() && !$file->hasMoved()) {
                if ($file->getSize() > $maxSize) {
                    continue; // Skip file terlalu besar
                }

                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    continue; // Skip tipe file tidak diizinkan
                }

                // Buat nama baru untuk file
                $newName = $ticketId . '_' . time() . '_' . $file->getClientName();

                // Simpan file ke folder publik
                $file->move(FCPATH . 'uploads/tickets', $newName);

                // Simpan metadata ke database
                $this->insert([
                    'ticket_id' => $ticketId,
                    'file_name' => $newName, // Ini yang akan dipakai untuk akses file
                    'file_path' => 'uploads/tickets/' . $newName,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        return true;
    }
}
