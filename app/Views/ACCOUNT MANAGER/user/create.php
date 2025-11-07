<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row" style="margin-top: 20px;">
            <!-- Create New User Form -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Create New User
                        </h3>
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <form action="ACCOUNT MANAGER/user/store" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="username">
                                    <i class="fas fa-user text-info" style="margin-right: 8px;"></i> Username
                                </label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter username" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="email">
                                    <i class="fas fa-envelope text-info" style="margin-right: 8px;"></i> Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="role">
                                    <i class="fas fa-user-tag text-info" style="margin-right: 8px;"></i> Role
                                </label>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="USER" readonly>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="password">
                                    <i class="fas fa-lock text-info" style="margin-right: 8px;"></i> Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password" required>
                            </div>
                            <!-- Action Buttons -->
                            <div class="d-flex mt-3" style="gap: 10px;">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Save
                                </button>
                                <button type="reset" class="btn btn-warning px-4">
                                    <i class="fas fa-undo-alt me-2"></i> Reset
                                </button>
                                <a href="ACCOUNT MANAGER/user/user-manager" class="btn btn-danger px-4">
                                    <i class="fas fa-times-circle me-2"></i> Cancel
                                </a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>