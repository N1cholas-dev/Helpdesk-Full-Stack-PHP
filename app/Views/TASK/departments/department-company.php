<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="mb-4"><i class="fas fa-building" style="color: #9400d3; margin-right: 8px;"></i> <span
                style="color: #9400d3;">Departments</span></h3>

        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

        <script>
            document.title = "DEPARTMENT";
        </script>

        <!-- Row for two cards -->
        <div class="row">
            <!-- First Card: Department List -->
            <div class="col-md-9">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #9400d3; color: white;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-building text-white" style="margin-right: 8px;"></i> Department List
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="departmentTable">
                                <thead class="text-center" style="background-color: #9400d3; color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department): ?>
                                        <tr>
                                            <td class="text-center"><?= $department['id'] ?></td>
                                            <td><?= $department['name'] ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('TASK/departments/edit-department/' . $department['id']); ?>"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="TASK/departments/delete/<?= $department['id'] ?>" method="POST"
                                                    style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this department?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Manage departments efficiently and keep data updated.</small>
                    </div>
                </div>
            </div>

            <!-- Second Card: Create New Department Form -->
            <div class="col-md-3">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #9400d3; color: white;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-plus-circle text-white" style="margin-right: 8px;"></i> Create New
                            Department
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="TASK/departments/store" method="POST">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="department_name" class="form-label">
                                    <i class="fas fa-building" style="color: #9400d3; margin-right: 8px;"></i>
                                    Department Name
                                </label>
                                <input type="text" class="form-control" id="department_name" name="department_name"
                                    placeholder="Enter Department name" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn" style="background-color: #9400d3; color: white;"
                                    id="saveDepartment">
                                    <i class="fas fa-save"></i> Save Department
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Fill in the department details to add a new entry.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add SweetAlert and DataTable Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {
        // Ambil halaman terakhir dari localStorage
        var lastPage = localStorage.getItem('lastDepartmentPage') ? parseInt(localStorage.getItem('lastDepartmentPage')) : 0;

        // Inisialisasi DataTable dengan stateSave agar tetap menyimpan posisi scroll, sort, dan search
        var table = $('#departmentTable').DataTable({
            stateSave: true
        });

        // Jika ada halaman terakhir yang tersimpan, pindahkan ke sana
        if (!isNaN(lastPage) && lastPage > 0) {
            table.page(lastPage).draw(false);
        }

        // Simpan halaman saat pengguna berpindah halaman
        table.on('page', function () {
            localStorage.setItem('lastDepartmentPage', table.page());
        });

        // SweetAlert untuk success message
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= session()->getFlashdata('success'); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            <?php elseif (session()->getFlashdata('updated')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Updated!',
        text: 'Department has been successfully updated!',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });


        <?php elseif (session()->getFlashdata('success') === 'deleted'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Department has been successfully deleted!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        // Delete department dengan konfirmasi SweetAlert
        $(document).on('click', '.delete-department', function () {
            let form = $(this).closest('.delete-form');
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
                    form.submit();
                }
            });
        });

        // Hapus localStorage saat DataTable dihancurkan (kalau perlu)
        table.on('destroy', function () {
            localStorage.removeItem('lastDepartmentPage');
        });
    });
</script>

<?= $this->endSection(); ?>