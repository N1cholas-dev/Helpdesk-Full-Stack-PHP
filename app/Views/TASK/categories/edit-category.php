<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Edit User -->
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Menggunakan lebar penuh -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user-edit me-2"></i> Edit Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('TASK/categories/update/' . $category['id']); ?>" method="post">
                            <?= csrf_field(); ?>

                            <!-- Category Name Field -->
                            <div class="form-group mb-4">
                                <label for="name" class="d-flex align-items-center">
                                    <i class="fas fa-list text-info" style="margin-right: 10px;"></i>
                                    Category Name
                                </label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?= old('name', esc($category['name'])); ?>" required>
                            </div>

                            <!-- Action Buttons with Icons and Custom Alignment -->
                            <div class="d-flex mt-3" style="gap: 10px;"> <!-- Use gap for spacing between buttons -->
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Update
                                </button>
                                <a href="<?= base_url('TASK/categories/category'); ?>" class="btn btn-danger px-4">
                                    <i class="fas fa-times-circle me-2"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>