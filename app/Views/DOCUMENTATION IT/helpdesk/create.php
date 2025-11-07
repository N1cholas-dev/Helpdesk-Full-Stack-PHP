<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-ticket-alt" style="margin-right: 10px;"></i>
                        <h3 class="card-title mb-0">Create Ticket</h3>
                    </div>

                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

                    <div class="card-body">
                        <form method="POST" action="<?= base_url('DOCUMENTATION IT/helpdesk/store') ?>"
                            enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                            <!-- PIC -->
                            <div class="mb-3">
                                <label for="pic_id" class="form-label">
                                    <i class="fas fa-user-cog text-info"></i> Assigned PIC
                                </label>
                                <select id="pic_id" name="pic_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select PIC --</option>
                                    <?php foreach ($active_pics as $pic): ?>
                                        <option value="<?= $pic['id']; ?>"><?= $pic['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Request By -->
                            <div class="mb-3">
                                <label for="request_by_id" class="form-label">
                                    <i class="fas fa-user text-secondary"></i> Request By
                                </label>
                                <select name="request_by_id" id="request_by_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select Request By --</option>
                                    <?php foreach ($request_by_list as $item): ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Issue Owner -->
                            <div class="mb-3">
                                <label for="issue_owner_id" class="form-label">
                                    <i class="fas fa-user-tie text-dark"></i> Issue Owner
                                </label>
                                <select name="issue_owner_id" id="issue_owner_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select Issue Owner --</option>
                                    <?php foreach ($issue_owners as $item): ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <label for="priority" class="form-label">
                                    <i class="fas fa-exclamation-circle text-danger"></i> Priority
                                </label>
                                <select id="priority" name="priority" class="form-select" required>
                                    <option value="Normal">Normal</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Urgent">Urgent</option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">
                                    <i class="fas fa-folder text-primary"></i> Category
                                </label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="mb-3">
                                <label for="subcategory_id" class="form-label">
                                    <i class="fas fa-folder-open text-secondary"></i> Subcategory
                                </label>
                                <select id="subcategory_id" name="subcategory_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select Subcategory --</option>
                                    <?php foreach ($subcategories as $subcategory): ?>
                                        <option value="<?= $subcategory['id']; ?>"><?= $subcategory['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Department -->
                            <div class="mb-3">
                                <label for="department_id" class="form-label">
                                    <i class="fas fa-building text-info"></i> Department
                                </label>
                                <select id="department_id" name="department_id" class="form-select" required>
                                    <option value="" disabled selected>-- Select Department --</option>
                                    <?php foreach ($departments as $department): ?>
                                        <option value="<?= $department['id']; ?>"><?= $department['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Form Lampiran -->
                            <div class="mb-3">
                                <label for="attachment" class="form-label">
                                    <i class="fas fa-paperclip text-primary"></i> Lampiran (Optional)
                                </label>
                                <input type="file" name="attachment[]" class="form-control" id="attachment" multiple
                                    accept=".jpg,.jpeg,.png,.gif,.pdf,.docx,.xlsx,.zip,.rar,.7z">
                                <small class="form-text text-muted">Pilih file untuk diunggah (maksimum 10MB, format:
                                    JPG, PNG, PDF, DOCX, XLSX, ZIP, dll)</small>
                            </div>

                            <!-- Subject -->
<div class="mb-3">
    <label for="subject_dropdown" class="form-label">
        <i class="fas fa-tag text-success"></i> Subject
    </label>
    <div class="d-flex flex-column">
        <!-- Dropdown Select2 -->
        <select id="subject_dropdown" name="subject_dropdown" class="form-select select2 mb-2"
            style="width: 100%;" onchange="toggleSubjectInput();" required>
            <option value="" disabled selected>-- Select Subject --</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= esc($subject['description']); ?>">
                    <?= esc($subject['description']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Manual Input -->
        <input type="text" id="subject_input" name="subject" class="form-control mt-2"
            placeholder="Enter Subject" value="<?= old('subject'); ?>"
            onkeyup="toggleSubjectDropdown();" required>
    </div>
</div>

<!-- Problem -->
<div class="mb-3">
    <label for="problem_dropdown" class="form-label">
        <i class="fas fa-exclamation-triangle text-warning"></i> Problem
    </label>
    <div class="d-flex flex-column">
        <!-- Dropdown Select2 -->
        <select id="problem_dropdown" name="problem_id" class="form-select select2 mb-2"
            style="width: 100%;" onchange="toggleProblemInput();">
            <option value="" disabled selected>-- Select Problem --</option>
            <?php foreach ($problems as $problem): ?>
                <option value="<?= esc($problem['id']); ?>">
                    <?= esc($problem['description']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Manual Input -->
        <input type="text" id="problem_input" name="problem" class="form-control mt-2"
            placeholder="Enter Problem" value="<?= old('problem'); ?>"
            onkeyup="toggleProblemDropdown();">
    </div>
</div>

                            <!-- Ticket Date -->
                            <div class="mb-3">
                                <label for="ticket_date" class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Ticket Date
                                </label>
                                <input type="datetime-local" id="ticket_date" name="ticket_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save" style="margin-right: 8px;"></i>Save Ticket
                                </button>

                                <button type="reset" class="btn btn-warning px-4 py-2">
                                    <i class="fas fa-undo" style="margin-right: 8px;"></i>Reset
                                </button>

                                <a href="DOCUMENTATION IT/helpdesk/helpdesk-admin" class="btn btn-danger px-4 py-2">
                                    <i class="fas fa-times-circle" style="margin-right: 8px;"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .select2-container {
    width: 100% !important;
}
.select2-selection {
    border-radius: 5px;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi Select2 untuk semua elemen dengan class select2
        $('.select2').select2({
            width: '100%'
        });

        const subjectDropdown = document.getElementById('subject_dropdown');
        const subjectInput = document.getElementById('subject_input');
        const problemDropdown = document.getElementById('problem_dropdown');
        const problemInput = document.getElementById('problem_input');

        function toggleInput(dropdown, input) {
            input.disabled = !!dropdown.value; // Nonaktifkan input jika dropdown punya nilai
        }

        function toggleDropdown(input, dropdown) {
            dropdown.disabled = !!input.value.trim(); // Nonaktifkan dropdown jika input terisi
            if (dropdown.disabled) {
                $(dropdown).val(null).trigger('change'); // Reset Select2 jika dinonaktifkan
            }
        }

        // Subject events
        subjectDropdown.addEventListener('change', function () {
            subjectInput.value = subjectDropdown.value;
            toggleInput(subjectDropdown, subjectInput);
        });

        subjectInput.addEventListener('input', function () {
            toggleDropdown(subjectInput, subjectDropdown);
        });

        // Problem events
        problemDropdown.addEventListener('change', function () {
            const selectedText = problemDropdown.options[problemDropdown.selectedIndex]?.text || '';
            problemInput.value = selectedText;
            toggleInput(problemDropdown, problemInput);
        });

        problemInput.addEventListener('input', function () {
            toggleDropdown(problemInput, problemDropdown);
        });

        // Inisialisasi awal saat halaman dimuat
        toggleInput(subjectDropdown, subjectInput);
        toggleDropdown(subjectInput, subjectDropdown);
        toggleInput(problemDropdown, problemInput);
        toggleDropdown(problemInput, problemDropdown);
    });
</script>


<?= $this->endSection(); ?>