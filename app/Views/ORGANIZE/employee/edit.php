<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="mb-4">Edit Employee</h3>

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="fas fa-user-edit"></i> Edit Employee</h3>
            </div>

            <div class="card-body">
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <?= implode('<br>', session('errors')) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('ORGANIZE/employee/update/' . $employee['id']); ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?= esc($employee['name']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= esc($employee['email']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="" disabled>-- Select Department --</option>
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?= esc($department['id']); ?>"
                                        <?= $department['id'] == $employee['department'] ? 'selected' : '' ?>>
                                        <?= esc($department['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role" value="PICUSER" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_of_joining" class="form-label">Date of Joining</label>
                            <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                value="<?= esc($employee['date_of_joining']); ?>" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start" style="gap: 20px;">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle"></i> Update
                        </button>
                        <button type="reset" class="btn btn-warning">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="button" class="btn btn-danger" onclick="window.history.back();">
                            <i class="fas fa-times-circle"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>