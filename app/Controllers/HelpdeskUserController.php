<?php

namespace App\Controllers;

use App\Models\RequestByModel;
use App\Models\HelpdeskTicketModel;
use App\Models\EmployeeModel;
use App\Models\IssueOwnerModel;
use App\Models\SubjectModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Models\DepartmentModel;
use App\Models\ProblemModel;
use App\Models\PicModel;
use App\Models\TicketFeedbackModel;
use App\Models\NotificationModel;
use App\Models\TicketAttachmentModel;

class HelpdeskUserController extends BaseController
{
    private $ticketModel;
    private $employeeModel;
    private $requestByModel;
    private $issueOwnerModel;
    private $subjectModel;
    private $categoryModel;
    private $subcategoryModel;
    private $departmentModel;
    private $problemModel;
    private $ticketFeedbackModel;
    private $notificationModel;
    private $db;
    private $ticketattachmentModel;
    public function __construct()
    {
        // Inisialisasi model
        $this->ticketModel = new HelpdeskTicketModel();
        $this->employeeModel = new EmployeeModel();
        $this->requestByModel = new RequestByModel();
        $this->issueOwnerModel = new IssueOwnerModel();
        $this->subjectModel = new SubjectModel();
        $this->categoryModel = new CategoryModel();
        $this->subcategoryModel = new SubcategoryModel();
        $this->departmentModel = new DepartmentModel();
        $this->problemModel = new ProblemModel();
        $this->ticketFeedbackModel = new TicketFeedbackModel(); // Model rating
        $this->notificationModel = new NotificationModel(); // Model notifikasi
        $this->db = \Config\Database::connect(); // Inisialisasi database
        $this->ticketattachmentModel = new TicketAttachmentModel();

        helper(['form', 'session']); // Panggil helper
    }

    public function helpdesk()
    {
        $search = $this->request->getVar('search');
        $statusFilter = $this->request->getVar('status');
        $perPage = self::PER_PAGE;

        // Ambil ID user dari session
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi berakhir. Silakan login kembali.');
        }

        // Build query tiket dengan JOIN
        $this->ticketModel
            ->select('helpdesk_tickets.*, 
            subjects.description AS subject_name,
            problems.description AS problem_description, 
            categories.name AS category_name, 
            subcategories.name AS subcategory_name, 
            departments.name AS department_name,
            ticket_feedback.rating AS ticket_rating,
            ticket_feedback.comment AS ticket_comment,
            requester.username AS request_by_name,
            owner.username AS issue_owner_name')
            ->join('subjects', 'subjects.id = helpdesk_tickets.subject_id', 'left')
            ->join('problems', 'problems.id = helpdesk_tickets.problem_id', 'left')
            ->join('categories', 'categories.id = helpdesk_tickets.category_id', 'left')
            ->join('subcategories', 'subcategories.id = helpdesk_tickets.subcategory_id', 'left')
            ->join('departments', 'departments.id = helpdesk_tickets.department_id', 'left')
            ->join('ticket_feedback', 'ticket_feedback.ticket_id = helpdesk_tickets.id', 'left')
            ->join('users AS requester', 'requester.id = helpdesk_tickets.request_by_id', 'left')
            ->join('users AS owner', 'owner.id = helpdesk_tickets.issue_owner_id', 'left')
            ->groupStart()
            ->where('helpdesk_tickets.request_by_id', $userId)
            ->orWhere('helpdesk_tickets.issue_owner_id', $userId)
            ->groupEnd();

        // Filter status jika ada
        if (!empty($statusFilter) && $statusFilter !== 'All') {
            $this->ticketModel->where('helpdesk_tickets.status', $statusFilter);
        }

        // Filter pencarian
        if (!empty($search)) {
            $this->ticketModel->groupStart()
                ->like('helpdesk_tickets.subject', $search)
                ->orLike('helpdesk_tickets.priority', $search)
                ->orLike('helpdesk_tickets.status', $search)
                ->orLike('problems.description', $search)
                ->orLike('categories.name', $search)
                ->orLike('subcategories.name', $search)
                ->orLike('departments.name', $search)
                ->orLike('requester.username', $search)
                ->orLike('owner.username', $search)
                ->groupEnd();
        }

        // Ambil semua tiket yang terfilter
        $tickets = $this->ticketModel->findAll();

        // Tambahkan attachment untuk tiap tiket
        foreach ($tickets as &$ticket) {
            $ticket['attachments'] = $this->ticketattachmentModel
                ->where('ticket_id', $ticket['id'])
                ->findAll();
        }
        unset($ticket);

        // Data untuk dikirim ke view
        $data = [
            'tickets' => $tickets,
            'statusFilter' => $statusFilter,
            'pager' => $this->ticketModel->pager,
            'requestByList' => $this->requestByModel->findAll(),
            'issueOwnerList' => $this->issueOwnerModel->findAll(),
            'employees' => $this->employeeModel->findAll(),
            'problems' => $this->problemModel->findAll(),
            'categories' => $this->categoryModel->findAll(),
            'subcategories' => $this->subcategoryModel->findAll(),
            'departments' => $this->departmentModel->findAll(),
        ];

        return view('USER/helpdesk/helpdesk-user', $data);
    }

    public function rateTicket()
    {
        $data = $this->request->getJSON();

        if (!$data) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }

        $ticketId = $data->ticket_id ?? null;
        $userId = session()->get('user_id'); // atau sesuai login
        $rating = $data->rating ?? null;
        $comment = $data->comment ?? '';

        if (!$ticketId || !$userId || !$rating) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        // Cek apakah sudah pernah rating
        $feedback = $this->ticketFeedbackModel->where('ticket_id', $ticketId)->where('user_id', $userId)->first();
        if ($feedback) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kamu sudah memberi rating']);
        }

        $this->ticketFeedbackModel->insert([
            'ticket_id' => $ticketId,
            'user_id' => $userId,
            'rating' => $rating,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    const PER_PAGE = 10;
    public function getRating($ticketId)
    {
        $feedback = $this->ticketFeedbackModel->getFeedbackByTicket($ticketId);

        if ($feedback) {
            return $this->response->setJSON([
                'status' => 'success',
                'rating' => $feedback['rating'],
                'comment' => $feedback['comment']
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'No rating found']);
    }

    public function create()
    {
        $picModel = new PicModel();
        $categoryModel = new CategoryModel();
        $subcategoryModel = new SubcategoryModel();

        // Ambil hanya PIC yang statusnya 'active'
        $active_pics = $picModel->where('status', 'active')->findAll();

        // Fetch data
        $data = [
            'employees' => $this->employeeModel->findAll(),
            'issue_owners' => $this->issueOwnerModel->findAll(),
            'request_by_list' => $this->requestByModel->findAll(),
            'subjects' => $this->subjectModel->findAll(),
            'problems' => $this->problemModel->findAll(),
            'departments' => $this->departmentModel->findAll(),
            'categories' => $categoryModel->findAll(),
            'subcategories' => $subcategoryModel->findAll(),
            'active_pics' => $active_pics,
        ];

        return view('USER/helpdesk/create', $data);
    }

    public function store()
    {
        $helpdeskModel = new HelpdeskTicketModel();
        $problemModel = new ProblemModel();
        $attachmentModel = new TicketAttachmentModel();
        $subjectModel = new SubjectModel();

        $this->db->transStart(); // Mulai transaksi

        // Ambil input dari form
        $ticketDate = $this->request->getPost('ticket_date');
        $ticketDateFormatted = date('Y-m-d H:i:s', strtotime($ticketDate));
        $problem_id = $this->request->getPost('problem_id');
        $problem_text = $this->request->getPost('problem');

        // Insert problem jika ditulis manual
        if (!empty($problem_text)) {
            $problem_id = $problemModel->insert(['description' => $problem_text]);
        }

        // Ambil input subject
        $subject_text = $this->request->getPost('subject'); // manual input
        $subject_dropdown = $this->request->getPost('subject_dropdown'); // dari dropdown

        $subject_id = null;

        if (!empty($subject_text)) {
            // Jika input manual, insert sebagai subject baru
            $subject_id = $subjectModel->insert(['description' => $subject_text]);
        } elseif (!empty($subject_dropdown)) {
            // Jika pilih dari dropdown, ambil ID berdasarkan deskripsi
            $subjectData = $subjectModel->where('description', $subject_dropdown)->first();
            $subject_id = $subjectData['id'] ?? null;
        }

        // Data tiket
        $data = [
            'ticket_date' => $ticketDateFormatted,
            'priority' => $this->request->getPost('priority'),
            'subject_id' => $subject_id,
            'status' => 'Open',
            'pic_id' => $this->request->getPost('pic_id'),
            'request_by_id' => $this->request->getPost('request_by_id'),
            'user_id' => session('user_id'),
            'issue_owner_id' => $this->request->getPost('issue_owner_id'),
            'category_id' => $this->request->getPost('category_id'),
            'subcategory_id' => $this->request->getPost('subcategory_id'),
            'department_id' => $this->request->getPost('department_id'),
            'problem_id' => $problem_id,
        ];

        // Simpan tiket
        if ($helpdeskModel->insert($data)) {
            $ticketId = $helpdeskModel->insertID();

            // Proses upload lampiran
            $files = $this->request->getFileMultiple('attachment');
            if ($files && count($files) > 0 && $files[0]->getError() !== 4) {
                $attachmentModel->uploadAttachment($ticketId);
            }
        } else {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan tiket.');
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            return redirect()->back()->with('error', 'Gagal membuat tiket dan lampiran.');
        }

        return redirect()->to('/USER/helpdesk/helpdesk-user')->with('success', 'Tiket berhasil dibuat!');
    }

    public function edit($ticket_id)
    {
        $ticket = $this->ticketModel->find($ticket_id);

        if (!$ticket) {
            return redirect()->to('USER/helpdesk/helpdesk-user')->with('error', 'Ticket not found!');
        }

        $picModel = new PicModel();
        $categoryModel = new CategoryModel();
        $subCategoryModel = new SubCategoryModel();
        $departmentModel = new DepartmentModel();
        $problemModel = new ProblemModel(); // Tambahkan Model Problem

        // Ambil hanya PIC yang statusnya 'active'
        $active_pics = $picModel->where('status', 'active')->findAll();

        // Data untuk tampilan edit
        $data = [
            'ticket' => $ticket,
            'subjects' => $this->subjectModel->findAll(),
            'request_by_list' => $this->requestByModel->findAll(),
            'issue_owners' => $this->issueOwnerModel->findAll(),
            'employees' => $this->employeeModel->findAll(),
            'active_pics' => $active_pics, // Hanya PIC yang aktif
            'categories' => $categoryModel->findAll(), // Data kategori
            'subcategories' => $subCategoryModel->findAll(), // Data subkategori
            'departments' => $departmentModel->findAll(), // Data departemen
            'problems' => $problemModel->findAll(), // Data problem
        ];

        return view('USER/helpdesk/edit', $data);
    }

    // Memperbarui data tiket
    public function update($ticket_id)
    {
        $problemModel = new ProblemModel();
        $notificationModel = new NotificationModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ticket_date' => 'required|valid_date',
            'priority' => 'required',
            'subject' => 'permit_empty|min_length[3]',
            'subject_dropdown' => 'permit_empty',
            'problem' => 'permit_empty|min_length[3]',
            'problem_id' => 'permit_empty'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil Subject
        $subject = $this->request->getPost('subject');
        if (empty($subject)) {
            $subject = $this->request->getPost('subject_dropdown');
        }

        // Ambil Problem ID
        $problem_id = $this->request->getPost('problem_id');
        $problem_text = $this->request->getPost('problem');

        if (!empty($problem_text)) {
            $existingProblem = $problemModel->where('description', $problem_text)->first();
            if ($existingProblem) {
                $problem_id = $existingProblem['id'];
            } else {
                $problem_id = $problemModel->insert(['description' => $problem_text]);
            }
        }

        if (empty($problem_id)) {
            return redirect()->back()->with('error', 'You must select or enter a problem.');
        }

        // Ambil ticket dari DB
        $ticket = $this->ticketModel->find($ticket_id);
        $ticketDate = $ticket['ticket_date']; // Ambil dari DB, bukan dari form
        $status = $this->request->getPost('status');

        // Siapkan array data
        $data = [
            'priority' => $this->request->getPost('priority'),
            'subject' => $subject,
            'status' => $status,
            'pic_id' => $this->request->getPost('pic_id'),
            'request_by_id' => $this->request->getPost('request_by'),
            'issue_owner_id' => $this->request->getPost('issue_owner'),
            'category_id' => $this->request->getPost('category_id'),
            'subcategory_id' => $this->request->getPost('subcategory_id'),
            'department_id' => $this->request->getPost('department'),
            'problem_id' => $problem_id,
        ];

        // Ambil input end_date dari form
        $endDateInput = $this->request->getPost('end_date');
        // Jika end_date diisi, tetapi status belum Done/Closed → ubah status jadi 'Done'
        if (!empty($endDateInput) && $status !== 'Done' && $status !== 'Closed') {
            $status = 'Done'; // Otomatis set status jadi Done
        }

        // Update kembali array $data dengan status akhir
        $data['status'] = $status;
        // Logika untuk update end_date dan resolution_time
        if ($status === 'Done' || $status === 'Closed') {
            if ($endDateInput && strtotime($endDateInput) !== false) {
                $data['end_date'] = $endDateInput;

                // Hitung selisih waktu dalam detik
                $resolutionSeconds = strtotime($endDateInput) - strtotime($ticketDate);
                $data['resolution_time'] = $resolutionSeconds;
            }
        } elseif ($status === 'Open' || $status === 'In Progress') {
            $data['end_date'] = null;
            $data['resolution_time'] = null;
        }

        // Mulai transaksi DB
        $this->db->transStart();

        // Update ticket
        if (!$this->ticketModel->update($ticket_id, $data)) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update ticket. Please check your input.');
        }

        // Notifikasi
        $adminId = session()->get('admin_id');
        $adminOrPicId = $adminId ?? $ticket['pic_id'];
        $notificationModel->insert([
            'admin_id' => $adminOrPicId,
            'message' => "Tiket #$ticket_id telah diperbarui.",
            'status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('error', 'Tiket diperbarui, tetapi gagal menyimpan notifikasi.');
            return redirect()->to('USER/helpdesk/helpdesk-user');
        }

        session()->setFlashdata('success', 'Tiket berhasil diperbarui dan notifikasi dikirim.');
        return redirect()->to('USER/helpdesk/helpdesk-user');
    }

    // Menghapus tiket
    public function delete($id)
    {
        $ticket = $this->ticketModel->find($id);

        if ($ticket) {
            $this->ticketModel->delete($id);
            return redirect()->to('USER/helpdesk/helpdesk-user')->with('success', 'deleted');
        } else {
            return redirect()->to('admin')->with('error', 'Ticket not found');
        }
    }
}