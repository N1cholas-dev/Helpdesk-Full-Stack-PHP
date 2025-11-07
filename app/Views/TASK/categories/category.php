<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="mb-4"><i class="fas fa-list" style="margin-right: 8px; color: #ff4500;"></i> <span
                style="color: #ff4500;">Category Management</span></h3>

        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #ff4500; color: white;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-list" style="margin-right: 8px; color: white;"></i> Category List
                        </h3>
                    </div>

                    <script>
                        document.title = "CATEGORY";
                    </script>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categoryTable" class="table table-bordered">
                                <thead class="text-center" style="background-color: #ff4500; color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <tr>
                                                <td class="text-center"><?= $category['id'] ?></td>
                                                <td><?= $category['name'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('TASK/categories/edit-category/' . $category['id']); ?>"
                                                        class="btn btn-sm btn-info me-1">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <form action="<?= base_url('TASK/categories/category/delete/' . $category['id']); ?>"
                                                        method="POST" class="delete-form" style="display: inline;">
                                                        <?= csrf_field(); ?>
                                                        <button type="button" class="btn btn-sm btn-danger delete-category"
                                                            data-id="<?= $category['id'] ?>">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No categories available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Manage categories effectively and keep them up-to-date.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #ff4500; color: white;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-plus-circle" style="margin-right: 8px; color: white;"></i> Create New
                            Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('TASK/categories/store'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-list" style="margin-right: 8px; color: #ff4500;"></i> Category Name
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter category name" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn" style="background-color: #ff4500; color: white;">
                                    <i class="fas fa-save" style="margin-right: 8px; color: white;"></i>
                                    <span style="color: white;">Save Category</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Provide details to add a new category to the list.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!-- Load SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        var lastPage = localStorage.getItem('lastCategoryPage') ? parseInt(localStorage.getItem('lastCategoryPage')) : 0;
        var table = $('#categoryTable').DataTable({
            stateSave: true
        });
        if (!isNaN(lastPage) && lastPage > 0) {
            table.page(lastPage).draw(false);
        }
        table.on('page', function () {
            localStorage.setItem('lastCategoryPage', table.page());
        });

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
                text: 'Category has been successfully updated!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif (session()->getFlashdata('success') === 'deleted'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Category has been successfully deleted!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        $(document).on('click', '.delete-category', function () {
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

        table.on('destroy', function () {
            localStorage.removeItem('lastCategoryPage');
        });
    });
</script>

<?= $this->endSection(); ?>