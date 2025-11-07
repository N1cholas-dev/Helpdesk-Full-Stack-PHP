<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<script>
    document.title = "ACHIEVEMENT";
</script>
<div class="content-wrapper">
    <div class="card mb-4">
        <div class="card-header bg-gradient-primary text-white text-center">
            <h3>🏆 Achievement</h3>
        </div>
        <div class="card-body">
            <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
            <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
            <!-- TOP PIC -->
            <div class="mb-4">
                <h4 class="text-primary">🎯 PIC dengan Tiket Terbanyak</h4>
                <table id="topPICsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama PIC</th>
                            <th>Total Tiket</th>
                            <th>Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($topPICs)): ?>
                            <?php foreach ($topPICs as $pic): ?>
                                <tr>
                                    <td><?= esc($pic['name']) ?></td>
                                    <td><span class="badge bg-success rounded-pill"><?= $pic['total_tickets'] ?> tiket</span>
                                    </td>
                                    <td><span class="badge bg-primary">PIC</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center">Belum ada data PIC</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- TOP USER -->
            <div class="mb-4">
                <h4 class="text-warning">👤 User dengan Tiket Terbanyak</h4>
                <table id="topUsersTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Total Tiket</th>
                            <th>Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($topUsers)): ?>
                            <?php foreach ($topUsers as $user): ?>
                                <tr>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><span class="badge bg-success rounded-pill"><?= $user['total_tickets'] ?> tiket</span>
                                    </td>
                                    <td><span class="badge bg-warning text-dark">User</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center">Belum ada data User</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- ADMIN -->
            <div class="mb-4">
                <h4 class="text-danger">🛠️ Admin - Total Tiket Diajukan</h4>
                <table id="adminTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Total Tiket</th>
                            <th>Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($adminStat)): ?>
                            <tr>
                                <td><?= esc($adminStat['name']) ?></td>
                                <td><span class="badge bg-success rounded-pill"><?= $adminStat['total_tickets'] ?>
                                        tiket</span></td>
                                <td><span class="badge bg-danger">Admin</span></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center">Belum ada data Admin</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables JS and CSS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function () {
        $('#topPICsTable, #topUsersTable, #adminTable').DataTable({
            responsive: false,
            scrollX: true,
            fixedHeader: true,
            paging: true,
            language: {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<?= $this->endSection(); ?>