<?php

namespace App\Controllers;

use App\Models\HelpdeskTicketModel;
use App\Models\PicModel;
use App\Models\SubjectModel;
use App\Models\VendorModel;
use App\Models\InvoiceModel;

class Home extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $ticketModel = new HelpdeskTicketModel();
        $picModel = new PicModel();
        $subjectModel = new SubjectModel();
        $vendorModel = new VendorModel();
        $invoiceModel = new InvoiceModel();

        $currentDate = date('Y-m-d');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $previousMonth = date('m', strtotime('-1 month'));
        $previousYear = date('Y', strtotime('-1 month'));
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        // Ambil bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Cek apakah ada tiket di bulan ini
        $ticketsMonthly = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('MONTH(ticket_date)', $currentMonth)
            ->where('YEAR(ticket_date)', $currentYear)
            ->get()
            ->getRowArray();

        // Jika bulan ini kosong, pakai bulan sebelumnya
        if ($ticketsMonthly['ticket_count'] == 0) {
            $previousMonth = date('m', strtotime('-1 month'));
            $previousYear = date('Y', strtotime('-1 month'));

            $ticketsMonthly = $ticketModel->select('COUNT(id) as ticket_count')
                ->where('MONTH(ticket_date)', $previousMonth)
                ->where('YEAR(ticket_date)', $previousYear)
                ->get()
                ->getRowArray();
        }

        // Ambil tanggal awal dan akhir minggu ini
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        $ticketsWeekly = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('DATE(ticket_date) >=', $startOfWeek)
            ->where('DATE(ticket_date) <=', $endOfWeek)
            ->get()
            ->getRowArray();

        // Jika minggu ini kosong, ambil minggu terakhir bulan sebelumnya
        if ($ticketsWeekly['ticket_count'] == 0) {
            $startOfLastWeek = date('Y-m-d', strtotime('monday last week'));
            $endOfLastWeek = date('Y-m-d', strtotime('sunday last week'));

            $ticketsWeekly = $ticketModel->select('COUNT(id) as ticket_count')
                ->where('DATE(ticket_date) >=', $startOfLastWeek)
                ->where('DATE(ticket_date) <=', $endOfLastWeek)
                ->get()
                ->getRowArray();
        }

        // Ambil data harian
        $ticketsDaily = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('DATE(ticket_date)', date('Y-m-d'))
            ->get()
            ->getRowArray();

        // Jika hari ini kosong, ambil data terbaru yang ada
        if ($ticketsDaily['ticket_count'] == 0) {
            $lastTicketDate = $ticketModel->select('DATE(ticket_date) as last_date')
                ->orderBy('ticket_date', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();

            // Jika hari ini kosong, biarkan data kosong (tidak mengambil data sebelumnya)
if (empty($ticketsDaily['ticket_count'])) {
    $ticketsDaily = null;  // Biarkan kosong jika tidak ada data untuk hari ini
}
        }

        // Menampilkan hasil
        $data = [
            'daily' => $ticketsDaily['ticket_count'] ?? 0,
            'weekly' => $ticketsWeekly['ticket_count'] ?? 0,
            'monthly' => $ticketsMonthly['ticket_count'] ?? 0,
        ];

        // Mengambil jumlah tiket tahunan
        $totalTicketsAllYears = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('YEAR(ticket_date)', $currentYear)
            ->first();

        // Mengambil semua data tiket
        $tickets = $ticketModel->findAll();

        // Menghitung jumlah tiket per status
        $ticketsByStatus = $ticketModel->query("SELECT s.status_name, COALESCE(COUNT(t.id), 0) AS ticket_count FROM (SELECT 'Open' AS status_name UNION SELECT 'Closed' UNION SELECT 'Reject by IT' UNION SELECT 'Done') AS s LEFT JOIN helpdesk_tickets t ON s.status_name = t.status GROUP BY s.status_name")
            ->getResultArray();

        // Mengambil data tiket berdasarkan PIC dengan nama PIC
        $ticketsByPic = $ticketModel->select('helpdesk_tickets.pic_id, COUNT(helpdesk_tickets.id) as ticket_count, IFNULL(pics.name, "Unknown") as pic_name')
            ->join('pics', 'helpdesk_tickets.pic_id = pics.id', 'left')
            ->groupBy('helpdesk_tickets.pic_id')
            ->get()
            ->getResultArray();

        // Mengambil data tiket yang dibuat dalam dua bulan terakhir berdasarkan ticket_date
        $ticketsLastTwoMonths = $ticketModel->select("DATE(ticket_date) as date, COUNT(id) as ticket_count")
            ->where("((MONTH(ticket_date) = $previousMonth AND YEAR(ticket_date) = $currentYear) OR (MONTH(ticket_date) = $currentMonth AND YEAR(ticket_date) = $currentYear))")
            ->groupBy("DATE(ticket_date)")
            ->orderBy("DATE(ticket_date)", "ASC")
            ->get()
            ->getResultArray();

        // Menghitung jumlah tiket per tahun
        $ticketsByYear = $ticketModel->select('YEAR(ticket_date) as year, COUNT(id) as ticket_count')
            ->groupBy('YEAR(ticket_date)')
            ->get()
            ->getResultArray();

        // Total jumlah tiket keseluruhan
        $totalTickets = $ticketModel->countAll();

        // Jumlah tiket per PIC per bulan
        $ticketsPerPIC = $ticketModel->select('helpdesk_tickets.pic_id, MONTH(ticket_date) as month, COUNT(helpdesk_tickets.id) as ticket_count, IFNULL(pics.name, "Unknown") as pic_name')
            ->join('pics', 'helpdesk_tickets.pic_id = pics.id', 'left')
            ->groupBy('helpdesk_tickets.pic_id, MONTH(ticket_date)')
            ->get()
            ->getResultArray();

        // Mengambil jumlah tiket berdasarkan jam dari created_at
        $ticketsByHour = $ticketModel->select("HOUR(ticket_date) as hour, COUNT(id) as ticket_count")
            ->groupBy("HOUR(ticket_date)")
            ->orderBy("hour", "ASC")
            ->get()
            ->getResultArray();

        // Mengambil data lainnya
        $pics = $picModel->findAll();
        $subjects = $subjectModel->findAll();
        $vendors = $vendorModel->findAll();
        $invoices = $invoiceModel->findAll();

        $ticketsByPicOverTime = $ticketModel->select('DATE(ticket_date) as ticket_date, COUNT(id) as ticket_count')
            ->groupBy('DATE(ticket_date)')
            ->orderBy('ticket_date', 'ASC')
            ->get()
            ->getResultArray();

        // Mengambil jumlah invoice berdasarkan vendor
        $invoicesByVendor = $invoiceModel->select('invoices.vendor_id, COUNT(invoices.id) as invoice_count, vendors.name as vendor_name')
            ->join('vendors', 'invoices.vendor_id = vendors.id', 'left')
            ->groupBy('invoices.vendor_id')
            ->get()
            ->getResultArray();

        // Mengirimkan data ke view
        return view('DOCUMENTATION IT/dashboard/home', [
            'tickets' => $tickets,
            'ticketsByStatus' => $ticketsByStatus,
            'ticketsByPic' => $ticketsByPic,
            'ticketsThisMonth' => $ticketsLastTwoMonths,
            'pics' => $pics,
            'ticketsByYear' => $ticketsByYear,
            'ticketsDaily' => $ticketsDaily,
            'ticketsWeekly' => $ticketsWeekly,
            'ticketsMonthly' => $ticketsMonthly,
            'totalTicketsAllYears' => $totalTicketsAllYears,
            'subjects' => $subjects,
            'vendors' => $vendors,
            'invoices' => $invoices,
            'totalTickets' => $totalTickets,
            'ticketsPerPIC' => $ticketsPerPIC,
            'ticketsByPicOverTime' => $ticketsByPicOverTime,
            'ticketsByHour' => $ticketsByHour,
            'invoicesByVendor' => $invoicesByVendor,
        ]);
    }
}
