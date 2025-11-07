<?php

namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\VendorModel;

class InvoiceController extends BaseController
{
    protected $invoiceModel;
    protected $vendorModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();  // Inisialisasi model invoice
        $this->vendorModel = new VendorModel();    // Inisialisasi model vendor
    }

    // Method untuk menampilkan semua invoice
    public function index()
    {
        // Query untuk mengambil invoice dengan nama vendor
        $builder = $this->invoiceModel->builder();
        $builder->select('invoices.*, vendors.name as vendor_name');  // Menambahkan nama vendor
        $builder->join('vendors', 'vendors.id = invoices.vendor_id');  // Join tabel vendors dengan invoices
        $builder->orderBy('invoices.id');
        // Ambil semua data invoice
        $invoices = $builder->get()->getResultArray();

        // Ambil semua data vendor
        $vendors = $this->vendorModel->findAll();

        return view('DOCUMENTATION IT/invoice/bill', ['invoices' => $invoices, 'vendors' => $vendors]);
    }

    public function create()
    {
        $vendors = $this->vendorModel->findAll();
        return view('DOCUMENTATION IT/invoice/create', ['vendors' => $vendors]);
    }

    // Method untuk menyimpan invoice baru
    public function save()
    {
        $data = [
            'vendor_id' => $this->request->getPost('vendor_id'),
            'invoice_date' => $this->request->getPost('invoice_date'),
            'due_date' => $this->request->getPost('due_date'),
            'amount' => $this->request->getPost('amount'),
            'status' => 'Unpaid',
        ];

        if ($this->invoiceModel->save($data)) {
            session()->setFlashdata('message', 'Invoice berhasil dibuat!');
            return redirect()->to(base_url('DOCUMENTATION IT/invoice/bill'));
        } else {
            dd([
                'data' => $data,
                'errors' => $this->invoiceModel->errors()
            ]);
        }
    }

    // Menampilkan form untuk mengedit invoice berdasarkan ID
    public function edit($id)
    {
        $invoice = $this->invoiceModel->find($id);

        if (!$invoice) {
            // Jika invoice tidak ditemukan, redirect atau tampilkan error
            return redirect()->to('/invoice')->with('error', 'Invoice not found');
        }

        // Mengambil daftar vendor untuk dropdown
        $vendors = $this->vendorModel->findAll();

        // Menampilkan form edit dengan data invoice yang ada
        return view('DOCUMENTATION IT/invoice/edit', [
            'invoice' => $invoice,
            'vendors' => $vendors
        ]);
    }

    // Update data invoice
    public function update($id)
    {
        // Validasi input
        if (
            !$this->validate([
                'vendor_id' => 'required',
                'invoice_date' => 'required|valid_date',
                'due_date' => 'required|valid_date',
                'amount' => 'required|numeric',
                'status' => 'required|in_list[unpaid,paid,late]'
            ])
        ) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'vendor_id' => $this->request->getPost('vendor_id'),
            'invoice_date' => $this->request->getPost('invoice_date'),
            'due_date' => $this->request->getPost('due_date'),
            'amount' => $this->request->getPost('amount'),
            'status' => $this->request->getPost('status'),
            'payment_date' => $this->request->getPost('payment_date') // Tambahkan ini
        ];

        // Update data invoice berdasarkan ID
        if ($this->invoiceModel->update($id, $data)) {
            return redirect()->to('DOCUMENTATION IT/invoice/bill')->with('message', 'Invoice updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update invoice');
        }
    }

    // Method untuk mendapatkan data invoice per vendor
    public function getInvoiceData()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
        SELECT i.vendor_id, v.name AS vendor_name, COUNT(i.id) AS invoice_count 
        FROM invoices i
        JOIN vendors v ON i.vendor_id = v.id
        GROUP BY i.vendor_id
    ");

        $invoiceData = $query->getResultArray();
        return $this->response->setJSON($invoiceData);
    }

    // Method untuk menghapus invoice
public function delete($id)
{
    // Cari invoice terlebih dahulu untuk memastikan data ada
    $invoice = $this->invoiceModel->find($id);

    if (!$invoice) {
        return redirect()->to('DOCUMENTATION IT/invoice/bill')->with('error', 'Invoice not found.');
    }

    // Hapus data invoice
    if ($this->invoiceModel->delete($id)) {
        return redirect()->to('DOCUMENTATION IT/invoice/bill')->with('message', 'Invoice deleted successfully.');
    } else {
        return redirect()->to('DOCUMENTATION IT/invoice/bill')->with('error', 'Failed to delete invoice.');
    }
}

}
