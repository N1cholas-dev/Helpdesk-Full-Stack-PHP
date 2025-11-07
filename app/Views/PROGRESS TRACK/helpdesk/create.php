<?= $this->extend('layout/pic'); ?>

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
                    <form method="POST" action="<?= site_url('PROGRESS TRACK/helpdesk/store') ?>" enctype="multipart/form-data">
    <?= csrf_field(); ?>

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
                                <label for="request_by" class="form-label">
                                    <i class="fas fa-user text-secondary"></i> Request By
                                </label>
                                <select name="request_by" id="request_by" class="form-select" required>
                                    <option value="" disabled selected>-- Select Request By --</option>
                                    <?php foreach ($request_by_list as $item): ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Issue Owner -->
                            <div class="mb-3">
                                <label for="issue_owner" class="form-label">
                                    <i class="fas fa-user-tie text-dark"></i> Issue Owner
                                </label>
                                <select name="issue_owner" id="issue_owner" class="form-select" required>
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
                                <label for="category" class="form-label">
                                    <i class="fas fa-folder text-primary"></i> Category
                                </label>
                                <select id="category" name="category" class="form-select" required>
                                    <option value="" disabled selected>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="mb-3">
                                <label for="subcategory" class="form-label">
                                    <i class="fas fa-folder-open text-secondary"></i> Subcategory
                                </label>
                                <select id="subcategory" name="subcategory" class="form-select" required>
                                    <option value="" disabled selected>-- Select Subcategory --</option>
                                    <?php foreach ($subcategories as $subcategory): ?>
                                        <option value="<?= $subcategory['id']; ?>"><?= $subcategory['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Department -->
                            <div class="mb-3">
                                <label for="department" class="form-label">
                                    <i class="fas fa-building text-info"></i> Department
                                </label>
                                <select id="department" name="department" class="form-select" required>
                                    <option value="" disabled selected>-- Select Department --</option>
                                    <?php foreach ($departments as $department): ?>
                                        <option value="<?= $department['id']; ?>"><?= $department['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subject -->
                            <div class="mb-3">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-tag text-success"></i> Subject
                                </label>
                                <div class="d-flex flex-column">
                                    <select id="subject_dropdown" name="subject_dropdown"
                                        class="form-select select2 mb-2" style="max-width: 300px;"
                                        onchange="toggleSubjectInput();" required>
                                        <option value="" disabled selected>-- Select Subject --</option>
                                        <?php foreach ($subjects as $subject): ?>
                                            <option value="<?= $subject['description']; ?>"><?= $subject['description']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="text" id="subject_input" name="subject" class="form-control mt-2"
                                        placeholder="Enter Subject" value="<?= set_value('subject'); ?>"
                                        onkeyup="toggleSubjectDropdown();" required>
                                </div>
                            </div>

                            <!-- Problem -->
                            <div class="mb-3">
                                <label for="problem" class="form-label">
                                    <i class="fas fa-exclamation-triangle text-warning"></i> Problem
                                </label>
                                <div class="d-flex flex-column">
                                    <select id="problem_dropdown" name="problem_dropdown"
                                        class="form-select select2 mb-2" style="max-width: 300px;"
                                        onchange="toggleProblemInput();" required>
                                        <option value="" disabled selected>-- Select Problem --</option>
                                        <?php foreach ($problems as $problem): ?>
                                            <option value="<?= $problem['description']; ?>"><?= $problem['description']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="text" id="problem_input" name="problem" class="form-control mt-2"
                                        placeholder="Enter Problem" value="<?= set_value('problem'); ?>"
                                        onkeyup="toggleProblemDropdown();" required>
                                </div>
                            </div>

                            <!-- Ticket Date -->
                            <div class="mb-3">
                                <label for="ticket_date" class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Ticket Date
                                </label>
                                <input type="datetime-local" id="ticket_date" name="ticket_date" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save" style="margin-right: 8px;"></i>Save Ticket
                                </button>

                                <button type="reset" class="btn btn-warning px-4 py-2">
                                    <i class="fas fa-undo" style="margin-right: 8px;"></i>Reset
                                </button>

                                <a href="PROGRESS TRACK/helpdesk/helpdesk-pic" class="btn btn-danger px-4 py-2">
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

<script>
    function toggleSubjectInput() {
        document.getElementById('subject_input').disabled = !!document.getElementById('subject_dropdown').value;
    }

    function toggleProblemInput() {
        document.getElementById('problem_input').disabled = !!document.getElementById('problem_dropdown').value;
    }
</script>

<script>
    // Disable one subject field depending on the selection
    function toggleSubjectInput() {
        var dropdown = document.getElementById('subject_dropdown');
        var input = document.getElementById('subject_input');

        if (dropdown.value) {
            input.disabled = true;
        } else {
            input.disabled = false;
        }
    }

    function toggleSubjectDropdown() {
        var dropdown = document.getElementById('subject_dropdown');
        var input = document.getElementById('subject_input');

        if (input.value) {
            dropdown.disabled = true;
        } else {
            dropdown.disabled = false;
        }
    }
</script>

<?= $this->endSection(); ?>