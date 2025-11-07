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

class HelpdeskPicController extends BaseController
{
    // Mendeklarasikan model sebagai properti
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

        helper('form');
        helper(['session']);

    }
    // Definisikan konstanta
    const PER_PAGE = 10;
    public function helpdesk()
    {
        $search = $this->request->getVar('search');
        $perPage = self::PER_PAGE;
        $picId = session()->get('user_id'); // Ambil ID PIC dari sesi login

        // Mengambil data tiket yang hanya milik PIC yang sedang login
        $this->ticketModel->select('helpdesk_tickets.*, 
                            problems.description as problem_description, 
                            categories.name as category_name, 
                            subcategories.name as subcategory_name, 
                            departments.name as department_name')
            ->join('problems', 'problems.id = helpdesk_tickets.problem_id', 'left')
            ->join('categories', 'categories.id = helpdesk_tickets.category_id', 'left')
            ->join('subcategories', 'subcategories.id = helpdesk_tickets.subcategory_id', 'left')
            ->join('departments', 'departments.id = helpdesk_tickets.department_id', 'left')
            ->where('helpdesk_tickets.pic_id', $picId); // Filter berdasarkan PIC yang sedang login

        // Tambahkan filter pencarian jika ada
        if ($search) {
            $this->ticketModel->groupStart()
                ->like('helpdesk_tickets.subject', $search)
                ->orLike('helpdesk_tickets.priority', $search)
                ->orLike('helpdesk_tickets.status', $search)
                ->orLike('problems.description', $search)
                ->orLike('categories.name', $search)
                ->orLike('subcategories.name', $search)
                ->orLike('departments.name', $search)
                ->groupEnd();
        }

        // Ambil data tiket yang sudah difilter
        $tickets = $this->ticketModel->findAll();

        $data = [
            'tickets' => $tickets,
            'pager' => $this->ticketModel->pager,
            'requestByList' => $this->requestByModel->findAll(),
            'issueOwnerList' => $this->issueOwnerModel->findAll(),
            'employees' => $this->employeeModel->findAll(),
            'problems' => $this->problemModel->findAll(),
            'categories' => $this->categoryModel->findAll(),
            'subcategories' => $this->subcategoryModel->findAll(),
            'departments' => $this->departmentModel->findAll(),
        ];

        return view('PROGRESS TRACK/helpdesk/helpdesk-pic', $data);
    }

    // Menampilkan form untuk membuat tiket baru
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

        return view('PROGRESS TRACK/helpdesk/create', $data);
    }
    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ticket_date' => 'required|valid_date',
            'priority' => 'required',
            'subject' => 'permit_empty|min_length[5]',  // Allow empty, but if filled, it should have a minimum length
            'subject_dropdown' => 'permit_empty',  // Allow empty, if subject is selected from dropdown
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Tentukan subject yang digunakan
        $subject = $this->request->getPost('subject') ?: $this->request->getPost('subject_dropdown');

        // Cek apakah subject yang dimasukkan sudah ada di tabel subjects
        if ($subject && !$this->subjectModel->where('description', $subject)->first()) {
            // Jika subject belum ada, tambahkan ke tabel subjects
            $this->subjectModel->save(['description' => $subject]);
        }

        // Kumpulkan data lain
        $data = [
            'ticket_date' => $this->request->getPost('ticket_date'),
            'priority' => $this->request->getPost('priority'),
            'subject' => $subject,
            'status' => $this->request->getPost('status'),
            'pic_id' => $this->request->getPost('pic_id'),
            'request_by_id' => $this->request->getPost('request_by'),
            'issue_owner_id' => $this->request->getPost('issue_owner'),
        ];

        // Simpan tiket
        $this->ticketModel->save($data);

        // Set flashdata untuk pesan sukses
        session()->setFlashdata('success', 'created');

        // Redirect ke halaman daftar tiket dengan pesan sukses
        return redirect()->to('PROGRESS TRACK/helpdesk/helpdesk-pic');
    }
    public function edit($ticket_id)
    {
        $ticket = $this->ticketModel->find($ticket_id);

        if (!$ticket) {
            return redirect()->to('PROGRESS TRACK/helpdesk/helpdesk-pic')->with('error', 'Ticket not found!');
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

        return view('PROGRESS TRACK/helpdesk/edit', $data);
    }
    // Memperbarui data tiket
    public function update($ticket_id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ticket_date' => 'required|valid_date',
            'priority' => 'required',
            'subject' => 'permit_empty|min_length[5]', // Allow empty, but if filled, it should have a minimum length
            'subject_dropdown' => 'permit_empty',  // Allow empty, if subject is selected from dropdown
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Logika untuk memastikan hanya salah satu yang diisi, manual atau dropdown
        $subject = $this->request->getPost('subject') ?: $this->request->getPost('subject_dropdown');

        // Cek apakah keduanya kosong
        if (empty($this->request->getPost('subject')) && empty($this->request->getPost('subject_dropdown'))) {
            return redirect()->back()->with('error', 'You must fill either Subject or Subject Dropdown.');
        }

        // Kumpulkan data lainnya
        $data = [
            'ticket_date' => $this->request->getPost('ticket_date'),
            'priority' => $this->request->getPost('priority'),
            'subject' => $subject,
            'status' => $this->request->getPost('status'),
            'pic_id' => $this->request->getPost('pic_id'),
            'request_by_id' => $this->request->getPost('request_by'),
            'issue_owner_id' => $this->request->getPost('issue_owner'),
        ];

        // Update tiket
        $this->ticketModel->update($ticket_id, $data);

        // Redirect dengan flash data untuk menampilkan SweetAlert
        return redirect()->to('PROGRESS TRACK/helpdesk/helpdesk-pic')->with('success', 'updated');
    }
    // Menghapus tiket
    public function delete($id)
    {
        $ticket = $this->ticketModel->find($id);

        if ($ticket) {
            $this->ticketModel->delete($id);
            return redirect()->to('admin')->with('success', 'deleted');
        } else {
            return redirect()->to('admin')->with('error', 'Ticket not found');
        }
    }
}