<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Invoice List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #FF8C00; color: white;">
                        <h3 class="card-title">
                            <i class="fas fa-file-invoice me-2"></i> Invoice List
                        </h3>
                    </div>

                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                    <script>
                        document.title = "INVOICE";
                    </script>

                    <div class="card-body" style="background-color: white;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-subtitle text-muted">Manage and view all invoice records.</h5>
                            <a href="<?= site_url('DOCUMENTATION IT/invoice/create') ?>" class="btn btn-success">
                                <i class="fas fa-plus-circle me-1"></i> Create Invoice
                            </a>
                        </div>

                        <div class="table-responsive">
    <table id="invoiceTable" class="table table-bordered table-striped">
        <thead style="background-color: #FF8C00; color: white;">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Vendor</th>
                <th class="text-center">Description</th> <!-- Kolom Baru -->
                <th class="text-center">Invoice Date</th>
                <th class="text-center">Due Date</th>
                <th class="text-center">Payment Date</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($invoices as $invoice): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td><?= esc($invoice['vendor_name']) ?></td>
                    <td><?= esc($invoice['description']) ?></td> <!-- Data Description -->
                    <td><?= esc($invoice['invoice_date']) ?></td>
                    <td><?= esc($invoice['due_date']) ?></td>
                    <td><?= $invoice['payment_date'] ? esc($invoice['payment_date']) : 'N/A' ?></td>
                    <td><?= "Rp " . number_format($invoice['amount'], 2, ',', '.') ?></td>
                    <td class="text-center">
                        <?php
                        $status = strtolower($invoice['status']);
                        $badge = match ($status) {
                            'unpaid' => 'bg-danger',
                            'paid' => 'bg-success',
                            'late' => 'bg-dark text-white',
                            default => 'bg-secondary',
                        };
                        ?>
                        <span class="badge <?= $badge ?>"><?= ucfirst($status) ?></span>
                    </td>
                    <td class="text-center">
                        <a href="<?= site_url('DOCUMENTATION IT/invoice/edit/' . $invoice['id']) ?>"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= site_url('DOCUMENTATION IT/invoice/delete/' . $invoice['id']) ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this invoice?');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col-md-12 -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</div> <!-- content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<?php if (session()->getFlashdata('message')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= session()->getFlashdata('message'); ?>',
            timer: 3000,  // Alert will disappear after 3 seconds
            showConfirmButton: false
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= session()->getFlashdata('error'); ?>',
            timer: 3000,  // Alert will disappear after 3 seconds
            showConfirmButton: false
        });
    </script>
<?php endif; ?>


<script type="text/javascript">
    $(document).ready(function () {
        // Ambil halaman terakhir yang tersimpan sebelum reload
        var lastPage = localStorage.getItem('lastInvoicePage') ? parseInt(localStorage.getItem('lastInvoicePage')) : 0;

        // Inisialisasi DataTable dengan konfigurasi penyimpanan halaman terakhir
        var table = $('#invoiceTable').DataTable({
            responsive: true,  // Untuk responsive tabel
            pagingType: 'full_numbers',  // Menampilkan kontrol pagination lengkap
            language: {
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>', // Ikon halaman pertama
                    last: '<i class="fas fa-angle-double-right"></i>', // Ikon halaman terakhir
                    next: '<i class="fas fa-angle-right"></i>', // Ikon halaman selanjutnya
                    previous: '<i class="fas fa-angle-left"></i>' // Ikon halaman sebelumnya
                }
            }
        });

        // Jika ada halaman yang tersimpan, set kembali setelah DataTable terinisialisasi
        if (lastPage > 0) {
            table.page(lastPage).draw(false);
        }

        // Simpan halaman saat pengguna berpindah halaman
        table.on('page', function () {
            localStorage.setItem('lastInvoicePage', table.page());
        });

        // Bersihkan localStorage saat DataTable dihancurkan
        table.on('destroy', function () {
            localStorage.removeItem('lastInvoicePage');
        });
    });
</script>

<style>
    .bg-warning {
        background-color: #ffc107 !important;
        /* Warna Kuning */
    }

    /* CSS untuk Dark Mode */
    body.dark-mode .card-header.bg-warning {
        background-color: #1a1a1a !important;
        /* Background gelap pada header card */
        color: white !important;
        /* Teks putih agar kontras */
    }

    body.dark-mode .card-body {
        background-color: #2c2c2c !important;
        /* Background gelap untuk body card */
        color: white !important;
        /* Teks putih untuk card body */
    }

    body.dark-mode .table-responsive {
        background-color: #121212 !important;
        /* Latar belakang tabel gelap */
    }

    body.dark-mode .table th,
    body.dark-mode .table td {
        color: white !important;
        /* Teks putih di tabel */
    }

    body.dark-mode .table-striped tbody tr:nth-child(odd) {
        background-color: #333 !important;
        /* Warna striping gelap pada baris tabel */
    }

    body.dark-mode .table-striped tbody tr:nth-child(even) {
        background-color: #1e1e1e !important;
        /* Warna striping lebih gelap pada baris tabel */
    }

    /* Pagination dark mode */
    body.dark-mode .dataTables_paginate .paginate_button {
        background-color: #333 !important;
        /* Background gelap untuk tombol pagination */
        color: white !important;
        /* Teks putih pada tombol */
        border: 1px solid #555;
        /* Border tombol pagination */
    }

    body.dark-mode .dataTables_paginate .paginate_button:hover {
        background-color: #555 !important;
        /* Hover effect untuk tombol pagination */
    }

    body.dark-mode .dataTables_paginate .paginate_button.current {
        background-color: #1cc88a !important;
        /* Warna tombol halaman aktif */
        color: white !important;
    }
</style>

<?= $this->endSection(); ?>