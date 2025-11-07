<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Group Setting Title -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header custom-header">
                        <h3 class="card-title">
                            <i class="fas fa-users me-2"></i> Group Settings
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-subtitle text-muted">Manage and organize your groups effectively.</h5>
                            <a href="<?= site_url('ACCOUNT MANAGER/group/create') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Create New Group
                            </a>
                            <style>
                                /* Ubah warna header card */
                                .custom-header {
                                    background-color: rgb(174, 218, 71) !important;
                                    color: black !important;
                                }

                                /* Ubah warna thead */
                                .custom-thead {
                                    background-color: rgb(174, 218, 71) !important;
                                    color: black !important;
                                    /* Teks hitam agar kontras */
                                }

                                /* Pastikan DataTables tidak mengubah warna thead */
                                table.dataTable thead {
                                    background-color: rgb(174, 218, 71) !important;
                                    color: black !important;
                                }
                            </style>
                        </div>
                        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                        <script>
                            document.title = "GROUP";
                        </script>
                        <div class="table-responsive">
                            <table id="groupTable" class="table table-hover table-bordered">
                                <thead class="custom-thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Group Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($groups)): ?>
                                        <?php foreach ($groups as $group): ?>
                                            <tr>
                                                <td class="text-center"><?= $group['id'] ?></td>
                                                <td><?= $group['group_name'] ?></td>
                                                <td><?= $group['description'] ?></td>
                                                <td class="text-center">
                                                    <a href="ACCOUNT MANAGER/group/detail/<?= $group['id'] ?>"
                                                        class="btn btn-sm btn-success me-1">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a href="ACCOUNT MANAGER/group/edit/<?= $group['id'] ?>"
                                                        class="btn btn-sm btn-info me-1">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                        data-id="<?= $group['id'] ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No groups available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Group settings management. Powered by Helpdesk.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#groupTable').DataTable();

        // Delete confirmation alert
        $('.delete-btn').click(function () {
            let groupId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'settings/delete/' + groupId;
                }
            });
        });

        // Show alerts based on session flashdata
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= session()->getFlashdata('error') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('info')): ?>
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: '<?= session()->getFlashdata('info') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>