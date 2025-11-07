<?php

namespace App\Controllers;

use App\Models\HelpdeskTicketModel;
use App\Models\PicModel;
use App\Models\SubjectModel;
use App\Models\VendorModel;
use App\Models\InvoiceModel;

class HomePic extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $ticketModel = new HelpdeskTicketModel();
        $picModel = new PicModel();
        $subjectModel = new SubjectModel();
        $vendorModel = new VendorModel();
        $invoiceModel = new InvoiceModel();

        // Mengambil semua data tiket
        $tickets = $ticketModel->findAll();

        // Menghitung jumlah tiket per status
        $ticketsByStatus = $ticketModel->select('status, COUNT(id) as ticket_count')
            ->groupBy('status')
            ->get()
            ->getResultArray();

        // Mengambil data tiket berdasarkan PIC dengan nama PIC
        $ticketsByPic = $ticketModel->select('helpdesk_tickets.pic_id, COUNT(helpdesk_tickets.id) as ticket_count, IFNULL(pics.name, "Unknown") as pic_name')
            ->join('pics', 'helpdesk_tickets.pic_id = pics.id', 'left')
            ->groupBy('helpdesk_tickets.pic_id')
            ->get()
            ->getResultArray();

        // Mengambil data tiket yang dibuat dalam bulan ini berdasarkan ticket_date
        $currentMonth = date('m');
        $currentYear = date('Y');
        $ticketsThisMonth = $ticketModel->select('DATE(ticket_date) as date, COUNT(id) as ticket_count')
            ->where('MONTH(ticket_date)', $currentMonth)
            ->where('YEAR(ticket_date)', $currentYear)
            ->groupBy('DATE(ticket_date)')
            ->get()
            ->getResultArray();

        // Menghitung jumlah tiket per tahun
        $ticketsByYear = $ticketModel->select('YEAR(ticket_date) as year, COUNT(id) as ticket_count')
            ->groupBy('YEAR(ticket_date)')
            ->get()
            ->getResultArray();

        // Mengambil jumlah tiket harian
        $ticketsDaily = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('DATE(ticket_date)', date('Y-m-d'))
            ->first();

        // Mengambil jumlah tiket mingguan
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
        $ticketsWeekly = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('ticket_date >=', $startOfWeek)
            ->where('ticket_date <=', $endOfWeek)
            ->first();

        // Mengambil jumlah tiket bulanan
        $ticketsMonthly = $ticketModel->select('COUNT(id) as ticket_count')
            ->where('MONTH(ticket_date)', $currentMonth)
            ->where('YEAR(ticket_date)', $currentYear)
            ->first();

        // Mengambil jumlah tiket tahunan
        $totalTicketsAllYears = $ticketModel->select('COUNT(id) as ticket_count')
            ->first();

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
        return view('PROGRESS TRACK/dashboard/home', [
            'tickets' => $tickets,
            'ticketsByStatus' => $ticketsByStatus,
            'ticketsByPic' => $ticketsByPic,
            'ticketsThisMonth' => $ticketsThisMonth,
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
            'invoicesByVendor' => $invoicesByVendor, // ✅ Data Invoice Per Vendor
        ]);

    }
}
