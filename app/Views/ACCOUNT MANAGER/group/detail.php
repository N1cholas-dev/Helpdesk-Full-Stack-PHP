<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Detail Group -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title"><i class="fas fa-users me-2"></i> Group Detail</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group mb-3">
                                <label for="group_name" class="fw-bold"><i class="fas fa-user-group me-2"></i> Group
                                    Name</label>
                                <input type="text" class="form-control" id="group_name" name="group_name"
                                    value="<?= $group['group_name'] ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="fw-bold"><i class="fas fa-align-left me-2"></i>
                                    Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    readonly><?= $group['description'] ?></textarea>
                            </div>

                            <!-- Anggota -->
                            <div class="form-group mb-3">
                                <label for="employee_ids" class="fw-bold"><i class="fas fa-users me-2"></i>
                                    Members</label>
                                <ul class="list-group">
                                    <?php foreach ($groupEmployees as $groupEmployee): ?>
                                        <?php
                                        $employee = $employeeModel->find($groupEmployee['employee_id']);
                                        if ($employee):
                                            ?>
                                            <li class="list-group-item"><?= $employee['name']; ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Tombol Back -->
                            <div class="form-group">
                                <a href="ACCOUNT MANAGER/group/group-manager" class="btn btn-danger btn-sm">
                                    <i class="fas fa-arrow-left me-2"></i> Back
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