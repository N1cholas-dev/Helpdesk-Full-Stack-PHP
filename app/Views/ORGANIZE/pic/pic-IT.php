<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <h3 class="mb-4"><i class="fas fa-users" style="margin-right: 8px; color: #9acd32;"></i> Person In Charge
            Management</h3>

        <script>
            document.title = "PIC";
        </script>

        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
        
        <div class="row d-flex justify-content-between">
            <!-- PIC List Section -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #9acd32;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-users" style="margin-right: 8px; color: white;"></i> PIC List
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="picTable" class="table table-bordered table-striped">
                                <thead class="text-white text-center" style="background-color: #9acd32;">
                                    <tr>
                                        <th>ID</th>
                                        <th>PIC</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pics)): ?>
                                        <?php foreach ($pics as $pic): ?>
                                        <?php if (!empty($pic['id'])): ?>
                                            <!-- render row seperti biasa -->
                                        <?php endif; ?>

                                            <tr>
                                                <td><?= $pic['id'] ?></td>
                                                <td><?= $pic['name'] ?></td>
                                                <td>
                                                    <?php
                                                    $category = array_filter($categories, fn($cat) => $cat['id'] == $pic['category_id']);
                                                    echo $category ? reset($category)['name'] : 'N/A';
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <span id="status-<?= $pic['id'] ?>"
                                                        class="badge <?= $pic['status'] === 'Active' ? 'badge-success' : 'badge-secondary'; ?>">
                                                        <?= $pic['status'] ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                <?php
                                                // Pastikan ID valid untuk atribut HTML (hindari karakter aneh)
                                                $picId = (int)$pic['id']; // cast ke integer untuk keamanan
                                                $inputId = "toggle-" . $picId;
                                                ?>

                                                <div class="custom-control custom-switch">
                                                    <input
                                                        type="checkbox"
                                                        class="custom-control-input toggle-status"
                                                        id="<?= $inputId ?>"
                                                        <?= $pic['status'] == 'Active' ? 'checked' : ''; ?>
                                                        data-id="<?= $picId ?>">
                                                    <label class="custom-control-label" for="<?= $inputId ?>"></label>
                                                </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No PIC data available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create New PIC Form -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-header text-white" style="background-color: #9acd32;">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-plus-circle" style="margin-right: 8px; color: white;"></i> Create New PIC
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="ORGANIZE/pic/store" method="POST">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="employee_id">
                                    <i class="fas fa-users" style="margin-right: 8px; color: #9acd32;"></i> Employee
                                    Name
                                </label>
                                <select class="form-select" id="employee_id" name="employee_id" required>
                                    <option value="" disabled selected>-- Select Employee --</option>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="category_id">
                                    <i class="fas fa-list" style="margin-right: 8px; color: #9acd32;"></i> Category
                                </label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn text-white" style="background-color: #9acd32;">
                                    <i class="fas fa-save"></i> Save PIC
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert & jQuery CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {

        // SweetAlert flash messages
        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= esc(session()->getFlashdata('message')); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= esc(session()->getFlashdata('error')); ?>',
            });
        <?php endif; ?>

        // Toggle switch handling
        document.querySelectorAll('.toggle-status').forEach(toggle => {
            const id = toggle.dataset.id;

            // Ambil status dari localStorage dan tampilkan
            const savedStatus = localStorage.getItem(`status-${id}`);
            if (savedStatus !== null) {
                toggle.checked = savedStatus === 'Active';
                updateStatusLabel(id, toggle.checked);
            }

            toggle.addEventListener('change', function () {
                const isActive = this.checked;
                const newStatus = isActive ? 'Active' : 'Non-Active';

                // Simpan status ke localStorage
                localStorage.setItem(`status-${id}`, newStatus);

                // Update label UI
                updateStatusLabel(id, isActive);

                // Kirim AJAX request ke backend
                fetch(`ORGANIZE/pic/pic-IT/updateStatus/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_hash(); ?>'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? 'Nice...' : 'Oops...',
                        text: data.success ? 'Success to update status!' : 'Failed to update status!'
                    });
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error updating status.'
                    });
                });
            });
        });

        // Fungsi update label status
        function updateStatusLabel(id, isActive) {
            const label = document.querySelector(`#status-${id}`);
            label.textContent = isActive ? 'Active' : 'Non-active';
            label.className = isActive ? 'badge badge-success' : 'badge badge-secondary';
        }

        // Inisialisasi DataTables
        $('#picTable').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true
        });
    });
</script>

<?= $this->endSection(); ?>