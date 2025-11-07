<?= $this->extend('layout/pic'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Edit PIC -->
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Menggunakan lebar penuh -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user-edit me-2"></i> Edit PIC
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="user-manager/updatePic/<?= $pic['id'] ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <!-- Name Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="name">
                                        <i class="fas fa-user text-info me-2"></i> Name
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?= esc($pic['name']) ?>" required>
                                </div>

                                <!-- Category Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="category">
                                        <i class="fas fa-list-alt text-info me-2"></i> Category
                                    </label>
                                    <select class="form-control" id="category" name="category_id" required>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id'] ?>" <?= $pic['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                                <?= esc($category['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Status Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="status">
                                        <i class="fas fa-toggle-on text-info me-2"></i> Status
                                    </label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" <?= $pic['status'] == 'active' ? 'selected' : '' ?>>Active
                                        </option>
                                        <option value="non-active" <?= $pic['status'] == 'non-active' ? 'selected' : '' ?>>
                                            Non-Active</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex mt-3" style="gap: 10px;">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Update
                                </button>
                                <a href="user-manager" class="btn btn-danger px-4">
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