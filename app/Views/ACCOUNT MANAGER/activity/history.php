<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<script>
    document.title = "ACTIVITY";
</script>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Activity History Title -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header custom-header">
                        <h3 class="card-title">
                            <i class="fas fa-history me-2"></i> Activity History
                        </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-subtitle text-muted mb-3">Monitor and track user activities in the system.</h5>

                        <style>
                            .custom-header {
                                background-color: rgb(174, 218, 71) !important;
                                color: black !important;
                            }

                            .custom-thead {
                                background-color: rgb(174, 218, 71) !important;
                                color: black !important;
                            }

                            table.dataTable thead {
                                background-color: rgb(174, 218, 71) !important;
                                color: black !important;
                            }
                        </style>

                        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                        <div class="table-responsive">
                            <table id="activityTable" class="table table-hover table-bordered">
                                <thead class="custom-thead">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>User ID</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                        <th>Detail</th>
                                        <th>URL/Menu</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Activity log tracking. Powered by Helpdesk.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        if ($('#activityTable').length) {
            var lastPage = localStorage.getItem('lastPage');
            if (lastPage !== null) {
                lastPage = parseInt(lastPage) || 0;
            }

            var table = $('#activityTable').DataTable({
                ajax: {
                    url: "<?= site_url('ACCOUNT MANAGER/activity/history/fetch') ?>",
                    type: "POST",
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'created_at' },
                    { data: 'user_id' },
                    { data: 'role' },
                    { data: 'action' },
                    { data: 'details' },
                    { data: 'url_accessed' }
                ],
                stateSave: true
            });

            if (lastPage > 0) {
                table.page(lastPage).draw(false);
            }

            table.on('page', function () {
                localStorage.setItem('lastPage', table.page());
            });

            $('#searchBox').on('keyup change', function () {
                table.search(this.value).draw();
            });

            // Jalankan delete setiap 10 detik
            setInterval(function () {
                $.ajax({
                    url: "<?= site_url('ACCOUNT MANAGER/activity/history/autoDeleteOldLogs') ?>",
                    type: "POST",
                    success: function (res) {
                        console.log('Deleted: ' + res.deleted);
                        table.ajax.reload(null, false); // Reload data, tetap di halaman sekarang
                    },
                    error: function (err) {
                        console.error('Error deleting logs:', err);
                    }
                });
            }, 10000); // 10 detik
        }
    });
</script>

<?= $this->endSection() ?>