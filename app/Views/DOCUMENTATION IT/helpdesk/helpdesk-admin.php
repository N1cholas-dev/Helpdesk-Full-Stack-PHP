<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Title inside Card -->
                    <h2 class="text-center mb-4" style="font-size: 40px; font-weight: bold;">
                        <i class="fas fa-ticket-alt" style="margin-right: 10px; color: #1e90ff;"></i>
                        <span style="color: #1e90ff;">Helpdesk Tickets</span>
                    </h2>

                    <!-- Filter Controls -->
                    <div class="row">
                        <!-- Filter Status -->
                        <div class="col-md-6 mb-3">
                            <label>Filter Status:</label>
                            <select id="statusFilter" class="form-control" style="width: 100%;">
                                <option value="">Semua</option>
                                <option value="Open">Open</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                                <option value="Closed">Closed</option>
                                <option value="Reject by IT">Reject by IT</option>
                            </select>
                        </div>

                        <!-- Filter Category -->
                        <div class="col-md-6 mb-3">
                            <label>Filter Category:</label>
                            <select id="categoryFilter" class="form-control" style="width: 100%;">
                                <option value="">Semua</option>
                                <option value="INSTALASI SOFTWARE">INSTALASI SOFTWARE</option>
                                <option value="HARDWARE/PERIPHERAL">HARDWARE/PERIPHERAL</option>
                                <option value="ODOO BLI">ODOO BLI</option>
                                <option value="MIS">MIS</option>
                                <option value="NAV">NAV</option>
                                <option value="ODOO BSA">ODOO BSA</option>
                                <option value="TMS">TMS</option>
                                <option value="CCTV">CCTV</option>
                                <option value="ODOO MSU">ODOO MSU</option>
                                <option value="ODOO SJM">ODOO SJM</option>
                                <option value="OPTILOG">OPTILOG</option>
                                <option value="NETWORK/INTERNET">NETWORK/INTERNET</option>
                                <option value="EMAIL">EMAIL</option>
                                <option value="NAV WAREHOUSE PLUGIN">NAV WAREHOUSE PLUGIN</option>
                                <option value="VENDOR INVOICE MULTI DOCUMENT">VENDOR INVOICE MULTI DOCUMENT</option>
                                <option value="ICDS / MOBILE CY">ICDS / MOBILE CY</option>
                                <option value="RDP LAUNCHER">RDP LAUNCHER</option>
                                <option value="DAISY (KEMITRAAN 2024)">DAISY (KEMITRAAN 2024)</option>
                                <option value="WAREHOUSE WEB REPORT">WAREHOUSE WEB REPORT</option>
                                <option value="PORTAL / HELPDESK">PORTAL / HELPDESK</option>
                                <option value="TMS (SURABAYA)">TMS (SURABAYA)</option>
                            </select>
                        </div>

                        <!-- Filter Subcategory -->
                        <div class="col-md-6 mb-3">
                            <label>Filter Subcategory:</label>
                            <select id="subcategoryFilter" class="form-control" style="width: 100%;">
                                <option value="">Semua</option>
                                <option value="LAIN-LAIN">LAIN-LAIN</option>
                                <option value="TAMBAH / HAPUS USER">TAMBAH / HAPUS USER</option>
                                <option value="ERROR">ERROR</option>
                                <option value="REPAIR PRINTER">REPAIR PRINTER</option>
                                <option value="OPTILOG ROAD">OPTILOG ROAD</option>
                                <option value="OPTILOG CRM">OPTILOG CRM</option>
                                <option value="REPAIR KOMPUTER PC">REPAIR KOMPUTER PC</option>
                                <option value="CCTV RUSAK">CCTV RUSAK</option>
                                <option value="SHARING PRINTER / DOKUMEN">SHARING PRINTER / DOKUMEN</option>
                                <option value="WIFI TIDAK KONEK">WIFI TIDAK KONEK</option>
                                <option value="SETUP PRINTER BARU">SETUP PRINTER BARU</option>
                                <option value="TIDAK BISA TERIMA / KIRIM EMAIL">TIDAK BISA TERIMA / KIRIM EMAIL</option>
                                <option value="LAPOR ERROR">LAPOR ERROR</option>
                                <option value="Warehouse Report Auto Sender">Warehouse Report Auto Sender</option>
                                <option value="LAPOR ERROR LAINNYA">LAPOR ERROR LAINNYA</option>
                                <option value="PERBAIKAN / PERUBAHAN REPORT">PERBAIKAN / PERUBAHAN REPORT</option>
                                <option value="TAMBAH VENDOR / CUSTOMER / ITEM / UOM">TAMBAH VENDOR / CUSTOMER / ITEM / UOM</option>
                                <option value="TIDAK BISA POSTING">TIDAK BISA POSTING</option>
                                <option value="ICDS / APLIKASI CY">ICDS / APLIKASI CY</option>
                                <option value="UPDATE MASTER DATA ICD">UPDATE MASTER DATA ICD</option>
                                <option value="REINSTALL / SETTING SOFTWARE">REINSTALL / SETTING SOFTWARE</option>
                                <option value="INSTALL SOFTWARE">INSTALL SOFTWARE</option>
                                <option value="ERROR TIDAK BISA CONNECT">ERROR TIDAK BISA CONNECT</option>
                                <option value="AKSES VPN">AKSES VPN</option>
                                <option value="TIDAK BISA AKSES WEB">TIDAK BISA AKSES WEB</option>
                                <option value="REPAIR LAPTOP">REPAIR LAPTOP</option>
                                <option value="SETUP CCTV BARU">SETUP CCTV BARU</option>
                                <option value="NOMINAL TIDAK SESUAI">NOMINAL TIDAK SESUAI</option>
                                <option value="SETTING / KONFIGURASI NAV">SETTING / KONFIGURASI NAV</option>
                                <option value="BERITA">BERITA</option>
                                <option value="TAMBAH RUTE / UBAH BIAYA RUTE">TAMBAH RUTE / UBAH BIAYA RUTE</option>
                                <option value="KABEL TIDAK KONEK">KABEL TIDAK KONEK</option>
                            </select>
                        </div>

                        <!-- Filter Department -->
                        <div class="col-md-6 mb-3">
                            <label>Filter Department:</label>
                            <select id="departmentFilter" class="form-control" style="width: 100%;">
                                <option value="">Semua</option>
                                <option value="INVENTORY CONTROL">INVENTORY CONTROL</option>
                                <option value="TRUCKING">TRUCKING</option>
                                <option value="PURCHASING">PURCHASING</option>
                                <option value="FINANCE">FINANCE</option>
                                <option value="MARITIM SINAR UTAMA">MARITIM SINAR UTAMA</option>
                                <option value="HSE">HSE</option>
                                <option value="PLB">PLB</option>
                                <option value="ACCOUNTING">ACCOUNTING</option>
                                <option value="COE">COE</option>
                                <option value="CY/CR">CY/CR</option>
                                <option value="DISTRIBUSI">DISTRIBUSI</option>
                                <option value="SECURITY">SECURITY</option>
                                <option value="CFS">CFS</option>
                                <option value="TARUNA CIPTA KENCANA">TARUNA CIPTA KENCANA</option>
                                <option value="MARKETING">MARKETING</option>
                                <option value="IT">IT</option>
                                <option value="HRD">HRD</option>
                                <option value="SJM SURABAYA">SJM SURABAYA</option>
                                <option value="COMMERCIAL">COMMERCIAL</option>
                                <option value="SKI SURABAYA">SKI SURABAYA</option>
                            </select>
                        </div>
   
                        <!-- Elemen hidden dengan nilai dari PHP session -->
                        <span id="userDisplay" style="display: none;"><?= $_SESSION['name']; ?></span>

                        <!-- Table Container -->
                        <div class="table-responsive" style="background-color: #fffff; overflow:auto;">
                            <table id="tabelData" class="table table-striped table-bordered" style="width:100%;">
                                <thead class="bg-dodgerblue text-white">
                                    <tr>
                                        <th class="text-center">Ticket ID</th>
                                        <th class="text-center">PIC</th>
                                        <th class="text-center">Request By</th>
                                        <th class="text-center">Issue Owner</th>
                                        <th class="text-center">Priority</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Subcategory</th> <!-- Tambahkan subkategori -->
                                        <th class="text-center">Department</th> <!-- Tambahkan department -->
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Problem</th>
                                        <th class="text-center">Attachment</th> <!-- Tambahan kolom untuk lampiran -->
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Ticket Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Resolution Time</th>
                                        <th class="text-center">Rate</th> <!-- Tambahan Rate -->
                                        <th class="text-center">Comment</th> <!-- Tambahkan kolom Comment -->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <style>
                                    .content-wrapper {
                                        background-color: white;
                                    }

                                    /* Hover untuk tombol Edit */
                                    .btn-info {
                                        transition: background-color 0.3s ease, transform 0.2s ease;
                                    }

                                    .btn-info:hover {
                                        background-color: #007bff !important;
                                        /* Biru lebih terang */
                                        transform: scale(1.05);
                                        /* Membesar sedikit */
                                    }

                                    /* Hover untuk tombol Delete */
                                    .btn-danger {
                                        transition: background-color 0.3s ease, transform 0.2s ease;
                                    }

                                    .btn-danger:hover {
                                        background-color: #dc3545 !important;
                                        /* Merah lebih terang */
                                        transform: scale(1.05);
                                        /* Membesar sedikit */
                                    }
                                </style>

                                <style>
                                    /* Hover pada header tabel */
                                    thead tr th {
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                        padding: 12px;
                                    }

                                    thead tr th:hover {
                                        background-color: #0056b3 !important;
                                        /* Biru lebih gelap */
                                        color: #ffffff !important;
                                        /* Putih untuk kontras */
                                        cursor: pointer;
                                    }
                                </style>

                                <style>
                                    .content-wrapper {
                                        min-height: 100vh;
                                        /* Supaya card tetap penuh */
                                        display: flex;
                                        flex-direction: column;
                                    }
                                </style>

                                <style>
                                    .card {
                                        margin-bottom: 0 !important;
                                    }

                                    .card-body {
                                        padding-bottom: 20px !important;
                                    }
                                </style>

                                <style>
                                    .bg-dodgerblue {
                                        background-color: #1e90ff;
                                        /* Dodger Blue */
                                    }
                                </style>

                                <style>
                                    .btn-create-ticket {
                                        background-color: #1e90ff;
                                        color: white;
                                        padding: 8px 16px;
                                        display: flex;
                                        align-items: center;
                                        font-size: 16px;
                                        text-decoration: none;
                                        transition: background-color 0.3s ease, transform 0.2s ease;
                                        border-radius: 5px;
                                    }

                                    .btn-create-ticket i {
                                        margin-right: 10px;
                                        color: white;
                                    }

                                    .btn-create-ticket:hover {
                                        background-color: #187bcd;
                                        transform: scale(1.05);
                                    }
                                </style>

                                <style>
                                    /* Buat semua thead rata tengah */
                                    thead th {
                                        text-align: center !important;
                                        vertical-align: middle !important;
                                        display: table-cell !important;
                                        white-space: nowrap;
                                    }

                                    table.dataTable thead th {
                                        text-align: center !important;
                                        vertical-align: middle !important;
                                    }

                                    /* Atur lebar tetap untuk semua kolom kecuali Subject & Problem */
                                    th,
                                    td {
                                        white-space: nowrap;
                                        padding: 8px 12px;
                                        text-align: center;
                                        min-width: 120px;
                                        /* Lebar default */
                                    }

                                    /* Pastikan isi kolom Ticket ID benar-benar rata tengah */
                                    td:nth-child(1) {
                                        text-align: center !important;
                                    }

                                    /* Rata tengah untuk thead Subject & Problem */
                                    th:nth-child(9),
                                    /* Subject */
                                    th:nth-child(10)

                                    /* Problem */
                                        {
                                        text-align: center !important;
                                        vertical-align: middle !important;
                                        display: table-cell !important;
                                    }

                                    /* Atur lebar Subject */
                                    td:nth-child(9),
                                    th:nth-child(9) {
                                        white-space: normal;
                                        word-wrap: break-word;
                                        min-width: 300px;
                                        max-width: 500px;
                                        text-align: left !important;
                                        /* Isi tetap rata kiri */
                                    }

                                    /* Atur lebar Problem agar lebih besar */
                                    td:nth-child(10),
                                    th:nth-child(10) {
                                        white-space: normal;
                                        word-wrap: break-word;
                                        min-width: 600px;
                                        /* Problem lebih lebar */
                                        max-width: 900px;
                                        text-align: left !important;
                                        /* Isi tetap rata kiri */
                                    }

                                    /* Atur lebar Department, Category, dan Subcategory agar sama */
                                    td:nth-child(6),
                                    th:nth-child(6),
                                    /* Department */
                                    td:nth-child(7),
                                    th:nth-child(7),
                                    /* Category */
                                    td:nth-child(8),
                                    th:nth-child(8)

                                    /* Subcategory */
                                        {
                                        min-width: 200px !important;
                                        max-width: 300px !important;
                                    }


                                    /* Paksa thead agar tidak terpengaruh style lain */
                                    thead th {
                                        text-align: center !important;
                                        vertical-align: middle !important;
                                    }
                                </style>

                                <tbody>
                                    <?php foreach ($tickets as $ticket): ?>
                                        <tr>
                                            <td><?= $ticket['id'] ?></td>

                                            <!-- PIC -->
                                            <td>
                                                <?php
                                                $picName = 'Unknown';
                                                foreach ($employees as $employee) {
                                                    if ($employee['id'] == $ticket['pic_id']) {
                                                        $picName = $employee['name'];
                                                        break;
                                                    }
                                                }
                                                echo $picName;
                                                ?>
                                            </td>

                                            <!-- Request By -->
                                            <td>
                                                <?php
                                                $requestBy = null;
                                                foreach ($requestByList as $item) {
                                                    if ($item['id'] == $ticket['request_by_id']) {
                                                        $requestBy = $item;
                                                        break;
                                                    }
                                                }
                                                echo $requestBy ? $requestBy['name'] : 'Unknown';
                                                ?>
                                            </td>

                                            <!-- Issue Owner -->
                                            <td>
                                                <?php
                                                $issueOwner = null;
                                                foreach ($issueOwnerList as $item) {
                                                    if ($item['id'] == $ticket['issue_owner_id']) {
                                                        $issueOwner = $item;
                                                        break;
                                                    }
                                                }
                                                echo $issueOwner ? $issueOwner['name'] : 'Unknown';
                                                ?>
                                            </td>

                                            <!-- Priority -->
                                            <td>
                                                <?php
                                                $priorityClass = '';
                                                switch ($ticket['priority']) {
                                                    case 'Normal':
                                                        $priorityClass = 'bg-success';
                                                        break;
                                                    case 'Medium':
                                                        $priorityClass = 'bg-warning';
                                                        break;
                                                    case 'High':
                                                        $priorityClass = 'bg-danger';
                                                        break;
                                                    case 'Urgent':
                                                        $priorityClass = 'bg-dark';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge <?= $priorityClass ?>"><?= $ticket['priority'] ?></span>
                                            </td>

                                            <!-- Category -->
                                            <td><?= $ticket['category_name'] ?? 'No Category' ?></td>

                                            <!-- Subcategory -->
                                            <td><?= $ticket['subcategory_name'] ?? 'No Subcategory' ?></td>

                                            <!-- Department -->
                                            <td><?= $ticket['department_name'] ?? 'No Department' ?></td>

                                            <!-- Subject -->
                                            <td><?= $ticket['subject_name'] ?? 'No Subject' ?></td>

                                            <!-- Problem -->
                                            <td><?= $ticket['problem_description'] ?? 'No details' ?></td>

                                            <!-- Attachment -->
                                            <td>
                                                <?php if (!empty($ticket['attachments'])): ?>
                                                    <?php foreach ($ticket['attachments'] as $attachment): ?>
                                                        <a href="<?= base_url($attachment['file_path']) ?>" download>
                                                            <?= esc($attachment['file_name']) ?>
                                                        </a>
                                                        <br>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">No file</span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Ini diletakkan 1x di layout admin -->
                                            <span id="userDisplay" style="display:none;"><?= $_SESSION['name']; ?></span>

                                            <!-- Status -->
                                            <td>
                                                <?php
                                                $statusClass = '';
                                                switch ($ticket['status']) {
                                                    case 'Open':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'In Progress':
                                                        $statusClass = 'bg-info';
                                                        break;
                                                    case 'Done':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    case 'Closed':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                    case 'Reject by IT':
                                                        $statusClass = 'bg-danger';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge <?= $statusClass ?>"><?= $ticket['status'] ?></span>
                                            </td>

                                            <!-- Ticket Date -->
                                            <td><?= $ticket['ticket_date'] ?></td>

                                            <td><?= $ticket['end_date'] ?></td>

                                            <?php
                                            $resolution = $ticket['resolution_time']; // Resolusi dalam detik
                                            $days = floor($resolution / 86400); // 86400 detik = 1 hari
                                            $hours = floor(($resolution % 86400) / 3600); // Sisa jam
                                            $minutes = floor(($resolution % 3600) / 60); // Sisa menit
                                            ?>
                                            <td>
                                                <?php
                                                if ($days > 0) {
                                                    echo "$days hari $hours jam $minutes menit";
                                                } elseif ($hours > 0) {
                                                    echo "$hours jam $minutes menit";
                                                } else {
                                                    echo "$minutes menit";
                                                }
                                                ?>
                                            </td>

                                            <!-- Rating -->
                                            <td class="text-center">
                                                <?php if (!empty($ticket['ticket_rating'])): ?>
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <?php if ($i <= $ticket['ticket_rating']): ?>
                                                            <i class="fas fa-star text-warning"></i> <!-- Bintang penuh -->
                                                        <?php else: ?>
                                                            <i class="far fa-star text-muted"></i> <!-- Bintang kosong -->
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">Belum ada rating</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?= !empty($ticket['ticket_comment']) ? htmlspecialchars($ticket['ticket_comment']) : 'Belum ada komentar'; ?>
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <a href="DOCUMENTATION IT/helpdesk/edit<?= $ticket['id'] ?>"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="DOCUMENTATION IT/helpdesk/delete/<?= $ticket['id'] ?>"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                title: "Berhasil!",
                text: "<?= session()->getFlashdata('success'); ?>",
                icon: "success",
                confirmButtonText: "OK"
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                title: "Gagal!",
                text: "<?= session()->getFlashdata('error'); ?>",
                icon: "error",
                confirmButtonText: "Coba Lagi"
            });
        <?php endif; ?>
    });
</script>

<script>
    function fetchRating(ticketId) {
        $.ajax({
            url: `/helpdesk/getRating/${ticketId}`,
            method: 'GET',
            success: function (response) {
                if (response.status === 'success') {
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        starsHtml += i <= response.rating
                            ? '<i class="fas fa-star text-warning"></i>'
                            : '<i class="far fa-star text-muted"></i>';
                    }
                    $(`#rating-${ticketId}`).html(starsHtml); // Update tampilan bintang
                } else {
                    $(`#rating-${ticketId}`).html('<span class="text-muted">Belum ada rating</span>');
                }
            }
        });
    }

</script>

<script>
    document.title = "HELPDESK";
</script>

<script>
    function fetchRating(ticketId) {
        fetch(`<?= site_url('helpdesk/getRating') ?>/${ticketId}`)
            .then(response => response.json())
            .then(data => {
                let ratingDisplay = document.getElementById(`ratingDisplay_${ticketId}`);
                if (data.status === "success") {
                    ratingDisplay.innerHTML = "⭐".repeat(data.rating) + ` (${data.rating}) - ${data.comment || 'No comment'}`;
                } else {
                    ratingDisplay.innerHTML = "Belum ada rating";
                }
            })
            .catch(error => console.error("Error fetching rating:", error));
    }

    // Panggil fungsi ini untuk setiap tiket saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("[id^=ratingDisplay_]").forEach(el => {
            let ticketId = el.id.split("_")[1];
            fetchRating(ticketId);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        // Konfigurasi DataTables
        var dtOptions = {
            responsive: false,
            scrollX: true,
            autoWidth: false,
            dom: "<'d-flex justify-content-between align-items-center mt-3'lBf>" +
                "rt" +
                "<'d-flex justify-content-between align-items-center mt-3'i p>" +
                "<'clear'>",
            orderCellsTop: true,
            fixedHeader: true,
            buttons: [
                'copy',
                {
                    extend: 'excelHtml5',
                    messageTop: 'EXCEL.',
                    title: 'Report Tickets',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    messageTop: 'PDF.',
                    title: 'Report Tickets',
                    footer: true
                },
                {
                    extend: 'print',
                    messageTop: function () {
                        return 'You are printing this report.';
                    }
                }
            ],
            pagingType: 'full_numbers',
            language: {
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            }
        };

        // Cek apakah elemen tabel ada sebelum inisialisasi
        if ($('#tabelData').length) {
            var lastPage = localStorage.getItem('lastPage');
            if (lastPage !== null) {
                lastPage = parseInt(lastPage) || 0;
            }

            // Inisialisasi DataTable
            var table = $('#tabelData').DataTable(dtOptions);

            // Jika ada halaman terakhir, buka halaman tersebut
            if (lastPage > 0) {
                table.page(lastPage).draw(false);
            }

            // Simpan halaman yang dibuka ke localStorage
            table.on('page', function () {
                localStorage.setItem('lastPage', table.page());
            });

            // Pencarian real-time
            $('#searchBox').on('keyup change', function () {
                table.search(this.value).draw();
            });
        }

        // Inisialisasi Select2 pada filter dropdown
        $('#statusFilter, #categoryFilter, #subcategoryFilter, #departmentFilter').select2({
            placeholder: "Pilih filter",
            allowClear: true
        });

        // Filter Status
        $('#statusFilter').on('change', function () {
            var status = $(this).val();
            if (status) {
                table.column(11).search('^' + status + '$', true, false).draw(); // Kolom Status = index 10
            } else {
                table.column(11).search('').draw(); // Reset filter
            }
        });

        // Filter Category
        $('#categoryFilter').on('change', function () {
            var value = $(this).val();
            table.column(5).search(value ? '^' + value + '$' : '', true, false).draw();
        });

        // Filter Subcategory
        $('#subcategoryFilter').on('change', function () {
            var value = $(this).val();
            table.column(6).search(value ? '^' + value + '$' : '', true, false).draw();
        });

        // Filter Department
        $('#departmentFilter').on('change', function () {
            var value = $(this).val();
            table.column(7).search(value ? '^' + value + '$' : '', true, false).draw();
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (session()->getFlashdata('success') === 'created'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Ticket has been successfully created!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('success') === 'updated'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Ticket has been successfully updated!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('success') === 'deleted'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Ticket has been successfully deleted!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>