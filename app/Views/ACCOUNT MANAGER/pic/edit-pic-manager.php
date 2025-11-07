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
                            <i class="fas fa-user-edit me-2"></i> Edit User
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('ACCOUNT MANAGER/pic/update/' . $pic_user['id']) ?>" method="post">

                            <?= csrf_field(); ?>
                            <div class="row">
                                <!-- Username Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="username">
                                        <i class="fas fa-user text-info me-2"></i> Username
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= $pic_user['username'] ?>" required>
                                </div>
                                <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                                <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                                <!-- Email Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="email">
                                        <i class="fas fa-envelope text-info me-2"></i> Email
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?= $pic_user['email'] ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Password Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="password">
                                        <i class="fas fa-lock text-info me-2"></i> Password
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Leave blank to keep current password">
                                </div>

                                <!-- Role Field -->
                                <div class="form-group col-md-6 mb-4">
                                    <label for="role">
                                        <i class="fas fa-user-tag text-info me-2"></i> Role
                                    </label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="pic_user" <?= $pic_user['role'] == 'pic_user' ? 'selected' : '' ?>>
                                            PIC USER</option>
                                        <option value="admin" <?= $pic_user['role'] == 'admin' ? 'selected' : '' ?>>ADMIN
                                        </option>
                                        <option value="user" <?= $pic_user['role'] == 'user' ? 'selected' : '' ?>>USER
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex mt-3" style="gap: 10px;">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-check-circle me-2"></i> Update
                                </button>
                                <a href="ACCOUNT MANAGER/pic/pic-manager" class="btn btn-danger px-4">
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