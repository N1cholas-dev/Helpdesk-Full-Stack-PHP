<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Create Group -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">
                            <i class="fas fa-users me-2"></i> Create New Group
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="ACCOUNT MANAGER/group/group-manager/store" method="post">
                            <div class="form-group">
                                <label for="group_name">Group Name</label>
                                <input type="text" class="form-control" id="group_name" name="group_name" required
                                    placeholder="Enter group name">
                            </div>
                            <div class="form-group mt-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required
                                    placeholder="Enter group description"></textarea>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success mr-2">
                                    <i class="fas fa-save"></i> Save Group
                                </button>
                                <a href="ACCOUNT MANAGER/group/group-manager" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Cancel
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