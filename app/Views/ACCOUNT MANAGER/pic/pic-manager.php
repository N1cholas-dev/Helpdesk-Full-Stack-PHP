<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- PIC Users Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(21, 194, 191); color: white;">
                        <h3 class="card-title">
                            <i class="fas fa-user-tie me-2"></i> PIC Users
                        </h3>
                    </div>
                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                    <div class="card-body">
                        <!-- Tombol Create PIC User di bawah header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-subtitle text-muted">Manage PIC Users efficiently.</h5>
                            <a href="<?= site_url('ACCOUNT MANAGER/pic/create-pic-manager') ?>"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Create PIC User
                            </a>
                            <style>
                                /* Ubah warna header card */
                                .card-header {
                                    background-color: rgb(21, 194, 191) !important;
                                    color: white !important;
                                }

                                /* Ubah warna thead */
                                .custom-thead {
                                    background-color: rgb(21, 194, 191) !important;
                                    color: white !important;
                                    /* Teks tetap putih agar kontras */
                                }

                                /* Pastikan DataTables tidak mengubah warna thead */
                                table.dataTable thead {
                                    background-color: rgb(21, 194, 191) !important;
                                    color: white !important;
                                }
                            </style>
                        </div>
                        <script>
                            document.title = "PIC MANAGER";
                        </script>
                        <div class="table-responsive">
                            <table id="picUsersTable" class="table table-bordered table-striped text-center">
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
                                    <?php foreach ($picUsers as $pic): ?>
                                        <tr>
                                            <td><?= esc($pic['id'] ?? '-') ?></td>
                                            <td><?= esc($pic['username'] ?? '-') ?></td>
                                            <td><?= esc($pic['email'] ?? '-') ?></td>
                                            <td><?= esc($pic['role'] ?? '-') ?></td>
                                            <td>**********</td>
                                            <td>
                                                <a href="<?= site_url('ACCOUNT MANAGER/pic/edit-pic-manager/' . $pic['id']) ?>"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= site_url('ACCOUNT MANAGER/pic/delete/' . $pic['id']) ?>"
                                                    class="btn btn-sm btn-danger delete-user"
                                                    data-id="<?= esc($pic['id']) ?>">
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

<!-- DataTables Styles & Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert -->
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