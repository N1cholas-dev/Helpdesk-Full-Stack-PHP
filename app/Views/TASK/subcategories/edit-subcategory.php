<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Edit User -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user-edit me-2"></i> Edit Subcategory
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Form untuk Edit Subcategory -->
                        <form action="<?= base_url('TASK/subcategories/update/' . $subcategory['id']); ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group mb-4">
                                <label for="name" class="d-flex align-items-center">
                                    <i class="fas fa-tag text-info" style="margin-right: 10px;"></i> Subcategory Name
                                </label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?= old('name', esc($subcategory['name'])); ?>" required>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex mt-3" style="gap: 10px;"> <!-- Use gap for spacing between buttons -->
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Update
                                </button>
                                <a href="<?= base_url('TASK/subcategories/subcategory'); ?>"
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