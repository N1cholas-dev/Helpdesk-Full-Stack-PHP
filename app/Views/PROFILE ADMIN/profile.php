<?php $this->extend('layout/admin'); ?>

<?php $this->section('content'); ?>

<style>
    .content-wrapper {
        background-color: white;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid px-0">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card w-100 h-100 shadow border-0">
                    <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user"></i> User Details
                        </h3>
                    </div>

                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <!-- Profile Picture -->
                                <img src="<?= isset($admin['profile_picture']) && !empty($admin['profile_picture'])
                                    ? base_url('uploads/profile_pictures/' . $admin['profile_picture'])
                                    : base_url('dist/img/24.jpg'); ?>" alt="Profile Image"
                                    class="rounded-circle shadow mb-3" width="150" height="150"
                                    onerror="this.onerror=null; this.src='<?= base_url('dist/img/24.jpg'); ?>';">
                            </div>
                            <div class="col-md-6 col-sm-8 col-10 mx-auto">
                                <!-- Form Upload Profile Picture -->
                                <form action="<?= site_url('profile/upload'); ?>" method="post"
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
                    </div>

                    <!-- User Details Table -->
                    <div class="table-responsive mt-3 px-3">
                        <table id="userTable" class="table table-striped table-bordered">
                            <thead class="bg-teal text-white">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($admin)): ?>
                                    <tr>
                                        <td><?= esc($admin['username']); ?></td>
                                        <td><?= esc($admin['email']); ?></td>
                                        <td><?= strtoupper(esc($admin['role'])); ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            No user found.
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

<!-- Styling untuk tampilan lebih rapi -->
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

    .card-body {
        padding: 20px;
    }

    .table-responsive {
        padding-bottom: 20px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<script>
    // SweetAlert message after successful profile update
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Update Successful',
            text: '<?= session()->getFlashdata('success'); ?>',
            timer: 3000,  // Alert will disappear after 3 seconds
            showConfirmButton: false
        });
    <?php endif; ?>

    $(document).ready(function () {
        $('#userTable').DataTable({
            responsive: true,
            paging: true,  // Aktifkan pagination meskipun hanya 1 data
            searching: true,  // Aktifkan pencarian
            info: true,  // Tampilkan informasi jumlah data
            lengthChange: true,  // Tampilkan opsi "Show X entries"
            pageLength: 10,  // Default jumlah data per halaman
            language: {
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            }
        });
    });
</script>

<?php $this->endSection(); ?>