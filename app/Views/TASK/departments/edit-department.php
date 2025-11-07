<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Edit Department Title -->
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Menggunakan lebar penuh -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user-edit me-2"></i> Edit Department
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Form untuk Edit Department -->
                        <form action="TASK/departments/update/<?= $department['id']; ?>" method="POST">
                            <?= csrf_field(); ?>

                            <!-- Department Name Field -->
                            <div class="form-group mb-4">
                                <label for="department_name" class="d-flex align-items-center">
                                    <i class="fas fa-building text-info" style="margin-right: 10px;"></i>
                                    Department Name
                                </label>
                                <input type="text" name="department_name" id="department_name" class="form-control"
                                    value="<?= old('department_name', esc($department['name'])); ?>" required>
                            </div>

                            <!-- Action Buttons with Icons and Custom Alignment -->
                            <div class="d-flex mt-3" style="gap: 10px;"> <!-- Use gap for spacing between buttons -->
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Update
                                </button>
                                <a href="<?= base_url('TASK/departments/department-company'); ?>"
                                    class="btn btn-danger px-4">
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