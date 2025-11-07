<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="mb-4">
            <i class="fas fa-tag" style="margin-right: 8px; color: #4682b4;"></i>
            <span style="color: #4682b4;">Subcategories Management</span>
        </h3>

        <script>
            document.title = "SUBCATEGORY";
        </script>

        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white d-flex align-items-center" style="background-color: #4682b4;">
                        <i class="fas fa-tag" style="margin-right: 8px;"></i>
                        <h3 class="card-title">Subcategory List</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="subcategoryTable">
                                <thead style="background-color: #4682b4; color: white;" class="text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Subcategory</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($subcategories)): ?>
                                        <?php foreach ($subcategories as $subcategory): ?>
                                            <tr>
                                                <td class="text-center"><?= $subcategory['id'] ?></td>
                                                <td><?= $subcategory['name'] ?></td>
                                                <td>
                                                    <?= isset($categories[array_search($subcategory['category_id'], array_column($categories, 'id'))]) ?
                                                        $categories[array_search($subcategory['category_id'], array_column($categories, 'id'))]['name'] : 'Unknown' ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="TASK/subcategories/edit-subcategory/<?= $subcategory['id'] ?>"
                                                        class="btn btn-sm btn-info me-1">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="subcategory/delete/<?= $subcategory['id'] ?>" method="POST"
                                                        style="display:inline;" class="delete-form">
                                                        <?= csrf_field(); ?>
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No subcategories available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Manage subcategories efficiently.</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #4682b4; color: white;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-plus-circle" style="margin-right: 8px;"></i> Create New Subcategory
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('TASK/subcategories/store'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag" style="margin-right: 8px; color: #4682b4;"></i>
                                    <span style="color: #4682b4;">Subcategory Name</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter subcategory name" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">
                                    <i class="fas fa-list" style="margin-right: 8px; color: #4682b4;"></i>
                                    <span style="color: #4682b4;">Category</span>
                                </label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn" style="background-color: #4682b4; color: white;">
                                    <i class="fas fa-plus-circle" style="color: white; margin-right: 8px;"></i> Add
                                    Subcategory
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Fill in the details to create a new subcategory.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.0/dist/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Ambil halaman terakhir yang tersimpan sebelum reload
        var lastPage = localStorage.getItem('lastSubcategoryPage') ? parseInt(localStorage.getItem('lastSubcategoryPage')) : 0;

        // Inisialisasi DataTable dengan konfigurasi penyimpanan halaman terakhir
        var table = $('#subcategoryTable').DataTable();

        // Jika ada halaman yang tersimpan, set kembali setelah DataTable terinisialisasi
        if (lastPage > 0) {
            table.page(lastPage).draw(false);
        }

        // Simpan halaman saat pengguna berpindah halaman
        table.on('page', function () {
            localStorage.setItem('lastSubcategoryPage', table.page());
        });

        // Flash message dari session
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= session()->getFlashdata('success'); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('success') === 'updated'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Subcategory has been successfully updated!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('success') === 'deleted'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Subcategory has been successfully deleted!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        // Event delegation untuk tombol delete agar tetap berfungsi di semua halaman DataTables
        $(document).on('click', '.delete-btn', function () {
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

        // Bersihkan localStorage saat DataTable dihancurkan
        table.on('destroy', function () {
            localStorage.removeItem('lastSubcategoryPage');
        });
    });
</script>

<?= $this->endSection(); ?>