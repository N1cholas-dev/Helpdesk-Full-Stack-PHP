<?= $this->extend('layout/dashboard-layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Create Department -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Department</h3>
                    </div>
                    <div class="card-body">
                        <form action="department/store" method="POST">
                            <div class="form-group">
                                <label for="department_name">Department Name</label>
                                <input type="text" name="department_name" id="department_name" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>