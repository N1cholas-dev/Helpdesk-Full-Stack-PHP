<?php $this->extend('layout/admin'); ?>

<?php $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Helpdesk Tickets Title (Without Header) -->
        <div class="row mt-0"> <!-- Ganti mt-3 ke mt-0 agar margin atas hilang -->
            <div class="col-12">
                <!-- Title for Helpdesk Tickets -->
                <h2 class="text-center mb-4" style="margin-top: 20px;">
                    <i class="fas fa-user" style="margin-right: 10px; color: #6a5acd;"></i>
                    <span style="color: #6a5acd;">Employees</span>
                </h2>

                <script>
                    document.title = "NEW EMPLOYEE";
                </script>

                <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                <!-- Card for Add New Employee -->
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #6a5acd;">
                        <h3 class="card-title">
                            <i class="fas fa-user-plus" style="color: #fff;"></i> Add New Employee
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('ORGANIZE/employee/save'); ?>" method="post">
                            <div class="row">
                                <!-- Employee Form Fields -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label"><i class="fas fa-user"
                                            style="margin-right: 8px;"></i> Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter full name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label"><i class="fas fa-envelope"
                                            style="margin-right: 8px;"></i> Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email address" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label"><i class="fas fa-building"
                                            style="margin-right: 8px;"></i> Department</label>
                                    <select class="form-control" id="department" name="department" required>
                                        <option value="" disabled selected>-- Select Department --</option>
                                        <?php foreach ($departments as $department): ?>
                                            <option value="<?= esc($department['id']); ?>"><?= esc($department['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="PICUSER"
                                        readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_of_joining" class="form-label"><i class="fas fa-calendar-alt"
                                            style="margin-right: 8px;"></i> Date of Joining</label>
                                    <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                        required>
                                </div>
                            </div>

                            <!-- Tombol Add berada di tengah -->
                            <div class="d-flex justify-content-center" style="gap: 20px;">
                                <button type="submit" class="btn text-white" style="background-color: #6a5acd;">
                                    <i class="fas fa-paper-plane"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card for Employee List -->
                <div class="card mt-4 shadow-lg">
                    <div class="card-header text-white" style="background-color: #6a5acd;">
                        <h3 class="card-title">
                            <i class="fas fa-users"></i> Employee List
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php if (count($employees) > 0): ?>
                            <table id="employeeTable" class="table table-bordered table-striped table-hover">
                                <thead class="text-white" style="background-color: #6a5acd;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Role</th>
                                        <th>Date of Joining</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($employees as $employee): ?>
                                        <tr>
                                            <td><?= esc($employee['id']) ?></td>
                                            <td><?= esc($employee['name']) ?></td>
                                            <td><?= esc($employee['email']) ?></td>
                                            <td><?= esc($employee['department_name']) ?></td>
                                            <td><?= esc($employee['role']) ?></td>
                                            <td><?= esc($employee['date_of_joining']) ?></td>
                                            <td>
                                                <a href="<?= base_url('ORGANIZE/employee/edit/' . esc($employee['id'])) ?>"
                                                    class="btn text-white" style="background-color: #6a5acd;">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-info">No employees found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTable and SweetAlert Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<?php if (session()->get('message')): ?>
    <script>
        $(document).ready(function () {
            // Mendapatkan pesan dan tipe pesan
            let message = '<?= session()->get('message') ?>';
            let messageType = '<?= session()->get('message_type') ?>';

            // Menampilkan SweetAlert sesuai dengan tipe pesan
            if (messageType === 'create') {
                Swal.fire({
                    title: 'Success!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else if (messageType === 'update') {
                Swal.fire({
                    title: 'Updated!',
                    text: message,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function () {
        // Ambil halaman terakhir yang tersimpan sebelum reload
        var lastPage = localStorage.getItem('lastEmployeePage') ? parseInt(localStorage.getItem('lastEmployeePage')) : 0;

        // Inisialisasi DataTable dengan penyimpanan halaman terakhir
        var table = $('#employeeTable').DataTable({
            responsive: true,
            pagingType: 'full_numbers',
            language: {
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            }
        });

        // Jika ada halaman yang tersimpan, set kembali setelah DataTable terinisialisasi
        if (lastPage > 0) {
            table.page(lastPage).draw(false);
        }

        // Simpan halaman saat pengguna berpindah halaman
        table.on('page', function () {
            localStorage.setItem('lastEmployeePage', table.page());
        });

        // Bersihkan localStorage saat DataTable dihancurkan
        table.on('destroy', function () {
            localStorage.removeItem('lastEmployeePage');
        });
    });
</script>

<?php $this->endSection(); ?>