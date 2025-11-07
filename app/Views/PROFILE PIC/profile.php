<?php $this->extend('layout/pic'); ?>

<?php $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-cadetblue text-white">
                        <h3 class="card-title">
                            <i class="fas fa-user"></i> PIC Details
                        </h3>
                    </div>

                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                    
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <!-- Profile Picture -->
                                <img src="<?= isset($user['profile_picture']) && !empty($user['profile_picture'])
                                    ? base_url('uploads/profile_pictures/' . $user['profile_picture'])
                                    : base_url('dist/img/people6.png'); ?>" alt="Profile Image"
                                    class="rounded-circle shadow mb-3" width="150" height="150"
                                    onerror="this.onerror=null; this.src='<?= base_url('dist/img/people6.png'); ?>';">
                            </div>
                            <div class="col-md-6 col-sm-8 col-10 mx-auto">
                                <!-- Form Upload Profile Picture -->
                                <form action="<?= site_url('PROFILE PIC/upload'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="input-group">
                                        <input type="file" name="profile_picture" class="form-control" accept="image/*"
                                            required>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- PIC Details Table -->
                        <div class="table-responsive mt-3 px-3">
                            <table id="picDetailsTable" class="table table-striped table-bordered">
                                <thead class="bg-cadetblue text-white">
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($user)): ?>
                                        <tr>
                                            <td><?= esc($user['username']); ?></td>
                                            <td><?= esc($user['email']); ?></td>
                                            <td><?= strtoupper(esc($user['role'])); ?></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                No PIC found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-cadetblue {
        background-color: cadetblue !important;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #ddd;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<!-- Flashdata SweetAlert (Hanya jika ada pesan sukses) -->
<?php if (session()->getFlashdata('success')): ?>
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                title: 'Update Successful',
                text: '<?= esc(session()->getFlashdata('success')); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
<?php endif; ?>

<!-- Inisialisasi DataTable -->
<script>
    $(document).ready(function () {
        if ($('#picDetailsTable').length) {
            $('#picDetailsTable').DataTable({
                responsive: true,
                paging: true, // Pastikan paging aktif dulu untuk debugging
                searching: true, // Biarkan searching aktif dulu
                info: true, // Biarkan info aktif
                lengthChange: true,
                pageLength: 10,
                language: {
                    paginate: {
                        first: '<i class="fas fa-angle-double-left"></i>',
                        last: '<i class="fas fa-angle-double-right"></i>',
                        next: '<i class="fas fa-angle-right"></i>',
                        previous: '<i class="fas fa-angle-left"></i>'
                    }
                }
            });
        } else {
            console.error("Tabel dengan ID 'picDetailsTable' tidak ditemukan!");
        }
    });
</script>

<?php $this->endSection(); ?>