<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Admins Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header d-flex align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-users-cog me-2"></i> User Manager
                        </h3>
                    </div>

                    <style>
                        /* Ubah warna header card */
                        .custom-header {
                            background-color: rgb(99, 234, 139) !important;
                            color: white !important;
                        }

                        /* Ubah warna thead */
                        .custom-thead {
                            background-color: rgb(99, 234, 139) !important;
                            color: white !important;
                            /* Teks tetap putih agar kontras */
                        }

                        /* Pastikan DataTables tidak mengubah warna thead */
                        table.dataTable thead {
                            background-color: rgb(99, 234, 139) !important;
                            color: white !important;
                        }
                    </style>

                    <script>
                        document.title = "USER";
                    </script>

                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-subtitle text-muted">Manage and oversee user accounts effectively.</h5>
                            <a href="<?= site_url('ACCOUNT MANAGER/user/create') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Create User
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="adminTable" class="table table-bordered table-striped text-center">
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
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= esc($user['id']) ?></td>
                                            <td><?= esc($user['username']) ?></td>
                                            <td><?= esc($user['email']) ?></td>
                                            <td><?= esc($user['role']) ?></td>
                                            <td>**********</td>
                                            <td>
                                                <a href="<?= site_url('ACCOUNT MANAGER/user/edit/' . $user['id']) ?>"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-user"
                                                    data-id="<?= esc($user['id']) ?>">
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
</div>

<!-- SweetAlert & DataTables Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                title: "Success!",
                text: "<?= session()->getFlashdata('success') ?>",
                icon: "success",
                confirmButtonText: "OK"
            });
        <?php endif; ?>
    });
</script>

<script>
    $(document).ready(function () {
        let table = $('#adminTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        // Cek apakah ada halaman yang tersimpan di localStorage
        let savedPage = localStorage.getItem('currentPage');
        if (savedPage !== null) {
            table.page(parseInt(savedPage)).draw(false);
        }

        // Saat user berpindah halaman, simpan ke localStorage
        table.on('page.dt', function () {
            let pageInfo = table.page.info();
            localStorage.setItem('currentPage', pageInfo.page);
        });

        // Hapus halaman yang tersimpan setelah reload penuh
        if (performance.navigation.type === 1) {
            localStorage.removeItem('currentPage');
        }

        // SweetAlert untuk konfirmasi penghapusan
        $('.delete-user').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).data('id');
            let deleteUrl = "<?= site_url('ACCOUNT MANAGER/user/user-manager/delete/') ?>" + userId;

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });

</script>

<?= $this->endSection(); ?>