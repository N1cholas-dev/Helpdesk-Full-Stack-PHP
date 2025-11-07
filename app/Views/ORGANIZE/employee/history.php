<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    
<div class="container-fluid">
    <h3 class="mb-4 text-danger"><i class="fas fa-history me-2"></i>Employee History</h3>

    <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Dept</th>
            <th>Role</th>
            <th>Joined</th>
            <th>Action</th>
            <th>Action Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($history as $item): ?>
            <tr>
                <td><?= esc($item['name']) ?></td>
                <td><?= esc($item['email']) ?></td>
                <td><?= esc($item['department']) ?></td>
                <td><?= esc($item['role']) ?></td>
                <td><?= esc($item['date_of_joining']) ?></td>
                <td>
                    <span class="badge <?= $item['action'] === 'join' ? 'bg-success' : 'bg-danger' ?>">
                        <?= ucfirst($item['action']) ?>
                    </span>
                </td>
                <td><?= esc($item['action_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
<?= $this->endSection(); ?>
