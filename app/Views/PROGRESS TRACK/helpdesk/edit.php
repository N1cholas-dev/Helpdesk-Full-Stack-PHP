<?= $this->extend('layout/pic'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-ticket-alt" style="margin-right: 10px;"></i>
                        <h3 class="card-title mb-0">Edit Ticket</h3>
                    </div>

                    <span id="userDisplay" style="display: none;"></span>

                    <style>
                        #problem_dropdown {
                            max-width: 500px;
                            /* Sesuaikan dengan kebutuhan */
                            height: calc(2.5rem + 2px);
                            /* Samakan tinggi dengan input */
                            line-height: normal;
                            padding-top: 5px;
                            padding-bottom: 5px;
                            overflow: hidden;
                            /* Mencegah teks terlalu panjang */
                            text-overflow: ellipsis;
                            /* Tambahkan jika ingin teks terpotong dengan "..." */
                        }
                    </style>

                    <div class="card-body">
                        <form method="POST" action="<?= site_url('PROGRESS TRACK/helpdesk/update/' . $ticket['id']); ?>">

                            <?= csrf_field(); ?>

                            <!-- PIC -->
                            <div class="mb-3">
                                <label for="pic_id" class="form-label">
                                    <i class="fas fa-user-cog text-info"></i> Assigned PIC
                                </label>
                                <select id="pic_id" name="pic_id" class="form-select" required>
                                    <option value="" disabled>-- Select PIC --</option>
                                    <?php foreach ($active_pics as $pic): ?>
                                        <option value="<?= $pic['id']; ?>" <?= $ticket['pic_id'] == $pic['id'] ? 'selected' : ''; ?>><?= $pic['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Request By -->
                            <div class="mb-3">
                                <label for="request_by" class="form-label">
                                    <i class="fas fa-user text-secondary"></i> Request By
                                </label>
                                <select name="request_by" id="request_by" class="form-select" required>
                                    <option value="" disabled>-- Select Request By --</option>
                                    <?php foreach ($request_by_list as $item): ?>
                                        <option value="<?= $item['id']; ?>" <?= $ticket['request_by_id'] == $item['id'] ? 'selected' : ''; ?>><?= $item['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Issue Owner -->
                            <div class="mb-3">
                                <label for="issue_owner" class="form-label">
                                    <i class="fas fa-user-tie text-dark"></i> Issue Owner
                                </label>
                                <select name="issue_owner" id="issue_owner" class="form-select" required>
                                    <option value="" disabled>-- Select Issue Owner --</option>
                                    <?php foreach ($issue_owners as $item): ?>
                                        <option value="<?= $item['id']; ?>" <?= $ticket['issue_owner_id'] == $item['id'] ? 'selected' : ''; ?>><?= $item['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <label for="priority" class="form-label">
                                    <i class="fas fa-exclamation-circle text-danger"></i> Priority
                                </label>
                                <select id="priority" name="priority" class="form-select" required>
                                    <option value="Normal" <?= $ticket['priority'] == 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Medium" <?= $ticket['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium
                                    </option>
                                    <option value="High" <?= $ticket['priority'] == 'High' ? 'selected' : ''; ?>>High
                                    </option>
                                    <option value="Urgent" <?= $ticket['priority'] == 'Urgent' ? 'selected' : ''; ?>>Urgent
                                    </option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category" class="form-label">
                                    <i class="fas fa-folder text-primary"></i> Category
                                </label>
                                <select id="category" name="category_id" class="form-select" required>
                                    <option value="" disabled>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>" <?= $ticket['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                                            <?= $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Subcategory -->
                                <div class="mb-3">
                                    <label for="subcategory" class="form-label">
                                        <i class="fas fa-folder-open text-secondary"></i> Subcategory
                                    </label>
                                    <select id="subcategory" name="subcategory_id" class="form-select" required>
                                        <option value="" disabled>-- Select Subcategory --</option>
                                        <?php foreach ($subcategories as $subcategory): ?>
                                            <option value="<?= $subcategory['id']; ?>"
                                                <?= $ticket['subcategory_id'] == $subcategory['id'] ? 'selected' : ''; ?>>
                                                <?= $subcategory['name']; ?>
                                            </option>
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
                                            <option value="<?= $department['id']; ?>"
                                                <?= $ticket['department_id'] == $department['id'] ? 'selected' : ''; ?>>
                                                <?= $department['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-tasks text-primary"></i> Status
                                    </label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="Open" <?= $ticket['status'] == 'Open' ? 'selected' : ''; ?>>Open
                                        </option>
                                        <option value="In Progress" <?= $ticket['status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="Done" <?= $ticket['status'] == 'Done' ? 'selected' : ''; ?>>Done
                                        </option>
                                        <option value="Closed" <?= $ticket['status'] == 'Closed' ? 'selected' : ''; ?>>
                                            Closed
                                        </option>
                                        <option value="Reject by IT" <?= $ticket['status'] == 'Reject by IT' ? 'selected' : ''; ?>>Reject by IT</option>
                                    </select>
                                </div>

                                <!-- Tampilkan ticket_date sebagai readonly -->
                                <div class="mb-3">
                                    <label for="ticket_date" class="form-label">
                                        <i class="fas fa-calendar-alt text-primary"></i> Ticket Date (readonly)
                                    </label>
                                    <input type="datetime-local" id="ticket_date" name="ticket_date"
                                        class="form-control"
                                        value="<?= date('Y-m-d\TH:i', strtotime($ticket['ticket_date'])) ?>" readonly>
                                </div>

                                <!-- Field baru untuk end date -->
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">
                                        <i class="fas fa-calendar-check text-success"></i> End Date (for Done/Closed)
                                    </label>
                                    <input type="datetime-local" id="end_date" name="end_date" class="form-control"
                                        value="<?= $ticket['end_date'] ? date('Y-m-d\TH:i', strtotime($ticket['end_date'])) : '' ?>">
                                </div>


                                <?php
                                // Ambil subject description dari subject_id
                                $selected_subject_description = '';
                                foreach ($subjects as $subject) {
                                    if ($subject['id'] == $ticket['subject_id']) {
                                        $selected_subject_description = $subject['description'];
                                        break;
                                    }
                                }

                                ?>

                                <!-- SUBJECT -->
                                <div class="mb-3">
                                    <label for="subject_dropdown" class="form-label">
                                        <i class="fas fa-tag text-success"></i> Subject
                                    </label>
                                    <select id="subject_dropdown" class="form-select select2" style="width: 100%;"
                                        onchange="syncSubjectInput();">
                                        <option value="" disabled <?= $selected_subject_description == '' ? 'selected' : ''; ?>>-- Select Subject --</option>
                                        <?php foreach ($subjects as $subject): ?>
                                            <option value="<?= htmlspecialchars($subject['description']); ?>"
                                                <?= ($selected_subject_description == $subject['description']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($subject['description']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subject_input" class="form-label">Subject Description</label>
                                    <input type="text" id="subject_input" name="subject" class="form-control"
                                        placeholder="Enter Subject"
                                        value="<?= htmlspecialchars($selected_subject_description); ?>"
                                        oninput="clearSubjectDropdown();">
                                </div>
<!-- PROBLEM -->
<div class="mb-3">
    <label for="problem_dropdown" class="form-label">
        <i class="fas fa-exclamation-triangle text-danger"></i> Problem
    </label>
    <select id="problem_dropdown" name="problem_id" class="form-select select2"
        style="width: 100%;" onchange="syncProblemInput();">
        <option value="">-- Select Problem --</option>
        <?php foreach ($problems as $problem): ?>
            <option value="<?= $problem['id']; ?>"
                data-description="<?= htmlspecialchars($problem['description']); ?>"
                <?= ($ticket['problem_id'] == $problem['id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($problem['description']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Problem Description (Manual Input) -->
<div class="mb-3">
    <label for="problem_description" class="form-label">Problem Description</label>
    <input type="text" id="problem_description" name="problem_description" class="form-control"
    placeholder="Enter Subject"
        value="<?= isset($problemDescription) ? htmlspecialchars($problemDescription) : ''; ?>"
        oninput="clearProblemDropdown();">
</div>


                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success px-4 py-2">
                                        <i class="fas fa-save" style="margin-right: 8px;"></i>Update Ticket
                                    </button>

                                    <button type="reset" class="btn btn-warning px-4 py-2">
                                        <i class="fas fa-undo" style="margin-right: 8px;"></i>Reset
                                    </button>

                                <a href="PROGRESS TRACK/helpdesk/helpdesk-pic" class="btn btn-danger px-4 py-2">
                                        <i class="fas fa-times-circle" style="margin-right: 8px;"></i>Cancel
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    // Inisialisasi Select2 pada dropdown Subject
    $(document).ready(function () {
        $('#subject_dropdown').select2({
            placeholder: "-- Select Subject --",
            allowClear: true
        });
    });

    // Inisialisasi Select2 pada dropdown Problem
    $(document).ready(function () {
        $('#problem_dropdown').select2({
            placeholder: "-- Select Problem --",
            allowClear: true
        });
    });

    // Sinkronisasi antara dropdown problem dan input manual
    function syncProblemInput() {
        const dropdown = document.getElementById('problem_dropdown');
        const selectedOption = dropdown.options[dropdown.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        document.getElementById('problem_description').value = description || '';
    }

    // Clear dropdown problem jika input manual digunakan
    function clearProblemDropdown() {
        $('#problem_dropdown').val('').trigger('change');
    }

    // Sinkronisasi antara dropdown subject dan input manual
    function syncSubjectInput() {
        const selected = document.getElementById('subject_dropdown').value;
        document.getElementById('subject_input').value = selected;
    }

    // Clear dropdown subject jika input manual digunakan
    function clearSubjectDropdown() {
        document.getElementById('subject_dropdown').selectedIndex = 0;
    }

    // Event listener untuk reset form
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form");
        let subjectInput = document.getElementById("subject_input");
        let subjectDropdown = document.getElementById("subject_dropdown");
        let problemInput = document.getElementById("problem_description");
        let problemDropdown = document.getElementById("problem_dropdown");

        let defaultSubject = subjectDropdown.value;
        let defaultProblem = problemDropdown.value;

        // Reset form, pastikan nilai default untuk subject dan problem tetap terjaga
        form.addEventListener("reset", function () {
            setTimeout(() => {
                subjectInput.value = "";
                subjectDropdown.value = defaultSubject;
                problemInput.value = "";
                problemDropdown.value = defaultProblem;
            }, 10);
        });
    });
</script>

<?= $this->endSection(); ?>