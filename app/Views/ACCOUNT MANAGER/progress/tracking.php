<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>



<span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
<span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

<div class="content-wrapper">
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">
            <h3 class="text-center">Tracking Tiket (Semua Status)</h3>
        </div>
        <div class="card-body">

            <!-- Filter Status -->
            <div class="mb-3">
                <label>Filter Status:</label>
                <select id="statusFilter" class="form-control" style="width: 200px;">
                    <option value="">Semua</option>
                    <?php
                    $statuses = array_unique(array_column($tickets, 'status'));
                    foreach ($statuses as $status):
                        ?>
                        <option value="<?= esc($status) ?>"><?= esc($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Tiket</th>
                        <th>Subjek</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($ticket['id']) ?></td>
                            <td><?= esc($ticket['subject_name']) ?></td>
                            <td data-status="<?= esc($ticket['status']) ?>">
                                <span class="badge badge-<?=
                                    ($ticket['status'] == 'Open') ? 'primary' :
                                    (($ticket['status'] == 'In Progress') ? 'warning' :
                                        (($ticket['status'] == 'Done') ? 'success' :
                                            (($ticket['status'] == 'Closed') ? 'secondary' :
                                                (($ticket['status'] == 'Reject by IT') ? 'danger' : 'secondary'))))
                                    ?>">
                                    <?= esc($ticket['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?= $ticket['ticket_date'] ? date('d-m-Y H:i', strtotime($ticket['ticket_date'])) : '-' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables JS & CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    var table = $('#dataTable').DataTable({
        responsive: true,
        ordering: true,
        paging: true,
        searching: true,
        stateSave: true, // Simpan state
        language: {
            emptyTable: "Data tidak ditemukan"
        },
        columnDefs: [
            {
                targets: 3, // Kolom ke-3 (Status)
                createdCell: function (td, cellData, rowData, row, col) {
                    var status = $(td).data('status');
                    $(td).attr('data-search', status);
                    $(td).attr('data-order', status);
                }
            }
        ]
    });

    // Apply saved filter to dropdown
    var savedState = table.state.loaded();
    if (savedState) {
        var searchStatus = savedState.columns[3].search.search;
        $('#statusFilter').val(searchStatus);
    }

    // Filter status dari dropdown
    $('#statusFilter').on('change', function () {
        var status = $(this).val();
        if (status) {
            table.column(3).search(status).draw();
        } else {
            table.column(3).search('').draw();
        }
    });
</script>

<?= $this->endSection(); ?>