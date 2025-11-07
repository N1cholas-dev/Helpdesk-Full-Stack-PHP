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
                                <select id="category" name="category" class="form-select" required>
                                    <option value="" disabled>-- Select Category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>" <?= $ticket['category_id'] == $category['id'] ? 'selected' : ''; ?>><?= $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="mb-3">
                                <label for="subcategory" class="form-label">
                                    <i class="fas fa-folder-open text-secondary"></i> Subcategory
                                </label>
                                <select id="subcategory" name="subcategory" class="form-select" required>
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

                            <!-- Ticket Date -->
                            <div class="mb-3">
                                <label for="ticket_date" class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Ticket Date
                                </label>
                                <input type="datetime-local" id="ticket_date" name="ticket_date" class="form-control"
                                    value="<?= $ticket['ticket_date']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-tag text-success"></i> Subject
                                </label>
                                <div class="d-flex flex-column">
                                    <select id="subject_dropdown" name="subject_dropdown"
                                        class="form-select select2 mb-2" style="max-width: 300px;"
                                        onchange="syncSubjectInput();">
                                        <option value="" disabled selected>-- Select Subject --</option>
                                        <?php
                                        $subjectFound = false;
                                        foreach ($subjects as $subject):
                                            if (isset($ticket['subject']) && $ticket['subject'] == $subject['description']) {
                                                $subjectFound = true;
                                            }
                                            ?>
                                            <option value="<?= $subject['description']; ?>" <?= (isset($ticket['subject']) && $ticket['subject'] == $subject['description']) ? 'selected' : ''; ?>>
                                                <?= $subject['description']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <input type="text" id="subject_input" name="subject" class="form-control mt-2"
                                        placeholder="Enter Subject"
                                        value="<?= isset($ticket['subject']) ? htmlspecialchars($ticket['subject']) : ''; ?>"
                                        oninput="syncSubjectDropdown();">
                                </div>
                            </div>
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

                            <div class="mb-3">
                                <label for="problem_dropdown" class="form-label">
                                    <i class="fas fa-exclamation-triangle text-danger"></i> Problem
                                </label>
                                <select id="problem_dropdown" name="problem_id" class="form-control">
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

                            <div class="mb-3">
                                <label for="problem_description" class="form-label">Problem Description</label>
                                <input type="text" id="problem_description" class="form-control">
                                <!-- Hapus readonly -->
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form");
        let subjectInput = document.getElementById("subject_input");
        let subjectDropdown = document.getElementById("subject_dropdown");

        // Simpan nilai awal dropdown saat halaman pertama kali dimuat
        let defaultSubject = subjectDropdown.value;

        form.addEventListener("reset", function () {
            setTimeout(() => {
                subjectInput.value = ""; // Hapus input teks

                // Kembalikan dropdown ke nilai awalnya saat halaman pertama dimuat
                subjectDropdown.value = defaultSubject;
            }, 10);
        });
    });

    function syncSubjectInput() {
        let dropdown = document.getElementById("subject_dropdown");
        let input = document.getElementById("subject_input");

        // Jika memilih dari dropdown, isi input field
        input.value = dropdown.value;
    }

    // Ambil elemen
    let dropdown = document.getElementById("problem_dropdown");
    let inputField = document.getElementById("problem_description");

    // Saat dropdown berubah, ubah input field
    dropdown.addEventListener("change", function () {
        let selectedOption = dropdown.options[dropdown.selectedIndex];
        inputField.value = selectedOption.getAttribute("data-description") || "";
    });

    // Set deskripsi awal saat halaman dimuat
    dropdown.dispatchEvent(new Event("change"));
</script>

<?= $this->endSection(); ?>