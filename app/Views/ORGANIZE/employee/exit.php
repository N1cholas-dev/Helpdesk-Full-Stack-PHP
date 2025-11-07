<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Helpdesk Tickets Title (Without Header) -->
        <div class="row mt-0"> <!-- Ganti mt-3 ke mt-0 agar margin atas hilang -->
            <div class="col-12">
                <!-- Title for Helpdesk Tickets -->
                <h2 class="text-center mb-4" style="margin-top: 20px;">
                    <i class="fas fa-user" style="margin-right: 10px; color: #dc143c;"></i>
                    <span style="color: #dc143c;">Employees</span>
                </h2>

                <script>
                    document.title = "EXIT EMPLOYEE";
                </script>

                <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                <!-- Exit Employee Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-lg">
                            <div class="card-header" style="background-color: #dc143c; color: white;">
                                <h4 class="card-title m-0" style="display: flex; align-items: center;">
                                    <i class="fas fa-user-slash" style="margin-right: 8px;"></i> Exit Employee
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Tampilkan pesan sukses jika ada -->
                                <?php if (session()->getFlashdata('message')): ?>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success!',
                                                text: "<?= session()->getFlashdata('message') ?>",
                                                showConfirmButton: false,
                                                timer: 2500
                                            }); 
                                        });
                                    </script>
                                <?php elseif (session()->getFlashdata('error')): ?>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: "<?= session()->getFlashdata('error') ?>",
                                                showConfirmButton: false,
                                                timer: 2500
                                            });
                                        });
                                    </script>
                                <?php endif; ?>

                                <form action="<?= site_url('ORGANIZE/employee/submit') ?>" method="post" id="exitForm">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <!-- Employee ID sebagai Select2 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="employee_id" class="form-label">
                                                <i class="fas fa-id-badge" style="margin-right: 8px;"></i> Employee
                                            </label>
                                            <select class="form-select select2" id="employee_id" name="employee_id"
                                                required>
                                                <option value="" disabled selected>-- Select Employee --</option>
                                                <?php foreach ($employees as $employee): ?>
                                                    <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?> (ID:
                                                        <?= $employee['id'] ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Exit Date -->
                                        <div class="col-md-6 mb-3">
                                            <label for="exit_date" class="form-label">
                                                <i class="fas fa-calendar-alt" style="margin-right: 8px;"></i> Exit Date
                                            </label>
                                            <input type="date" class="form-control" id="exit_date" name="exit_date"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Tombol -->
                                    <div class="d-flex justify-content-start" style="gap: 20px;">
                                        <button type="submit" class="btn btn-danger" id="submitBtn">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery dan Select2 JS jika belum -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#employee_id').select2({
            placeholder: "-- Select Employee --",
            allowClear: true
        });
    });
</script>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById("exitForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah form dikirim langsung

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete this employee.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc143c", // warna yang telah disesuaikan
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit form jika user menekan "Yes"
            }
        });
    });
</script>

<?= $this->endSection(); ?>