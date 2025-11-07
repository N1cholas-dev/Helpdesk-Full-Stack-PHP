<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<style>
    /* Warna thead menjadi dark orange */
    .custom-thead {
        background-color: #FF8C00 !important;
        /* Dark Orange */
        color: white !important;
        /* Teks putih agar kontras */
    }

    /* Pastikan warna tidak hilang saat di-render oleh DataTable */
    table.dataTable thead {
        background-color: #FF8C00 !important;
        color: white !important;
    }

    /* CSS untuk Dark Mode */
    body.dark-mode .content-wrapper {
        background-color: #121212 !important;
        /* Background gelap untuk content-wrapper */
    }

    body.dark-mode .card-body {
        background-color: #1e1e1e !important;
        /* Background gelap untuk card-body */
        color: white;
        /* Pastikan teks tetap terlihat */
    }

    body.dark-mode table.dataTable thead {
        background-color: #FF8C00 !important;
        /* Warna header tabel tetap oranye */
        color: white !important;
    }

    /* Pastikan tabel dan elemen lain juga disesuaikan dengan dark mode */
    body.dark-mode table.dataTable {
        background-color: #2c2c2c !important;
        /* Tabel dengan latar belakang gelap */
        color: white;
        /* Warna teks tabel */
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Admins Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-header" style="background-color: #FF8C00; color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-user-shield me-2"></i> Admin
                    </h3>
                </div>
                <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                <script>
                    document.title = "ADMIN";
                </script>
                <div class="card-body" style="background-color: white;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-subtitle text-muted">Manage and oversee admin accounts effectively.</h5>
                        <a href="<?= site_url('ACCOUNT MANAGER/admin/create') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle me-1"></i> Create Admin
                        </a>

                    </div>
                    <div class="table-responsive">
                        <table id="adminTable" class="table table-bordered table-striped">
                            <thead class="custom-thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admins as $admin): ?>
                                    <tr>
                                        <td><?= esc($admin['id']) ?></td>
                                        <td><?= esc($admin['username']) ?></td>
                                        <td><?= esc($admin['email']) ?></td>
                                        <td><?= esc($admin['role']) ?></td>
                                        <td>**********</td>
                                        <td>
                                            <a href="<?= base_url('ACCOUNT MANAGER/admin/edit/' . $admin['id']) ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= site_url('ACCOUNT MANAGER/admin/delete/' . $admin['id']) ?>"
                                                class="btn btn-sm btn-danger delete-user"
                                                data-id="<?= esc($admin['id']) ?>">
                                                <i class="fas fa-trash"></i> Delete
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

<!-- jQuery dan DataTables JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#adminTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>
<!-- Add SweetAlert and DataTable Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<script>
    <?php if (session()->getFlashdata('success_message')): ?>
        let type = '<?= session()->getFlashdata('success_type'); ?>';
        let title = '';
        switch (type) {
            case 'created':
                title = 'Created!';
                break;
            case 'updated':
                title = 'Updated!';
                break;
            case 'deleted':
                title = 'Deleted!';
                break;
            default:
                title = 'Success!';
        }

        Swal.fire({
            icon: 'success',
            title: title,
            text: '<?= session()->getFlashdata('success_message'); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>

<?= $this->endSection(); ?>