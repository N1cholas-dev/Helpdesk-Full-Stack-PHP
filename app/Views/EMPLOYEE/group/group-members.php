<?= $this->extend('layout/pic'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Members of Group</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="text-primary">Group ID: <?= $group_id; ?></h4>
                        <div class="list-group">
                            <?php if (!empty($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><?= $employee['name']; ?></span>
                                        <a href="#" class="btn btn-info btn-sm">View</a> <!-- Example button -->
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item text-muted">No members in this group yet.</li>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer text-center text-muted">
                        <small>Manage group members efficiently.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
