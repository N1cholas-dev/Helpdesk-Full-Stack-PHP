<?= $this->extend('layout/pic'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Edit Group -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Edit Group</h3>
                    </div>
                    <div class="card-body">
                        <form action="group-pic/save/<?= $group['id'] ?>" method="post">
                            <div class="form-group">
                                <label for="group_name">Group Name</label>
                                <input type="text" class="form-control" id="group_name" name="group_name"
                                    value="<?= $group['group_name'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    required><?= $group['description'] ?></textarea>
                            </div>

                            <!-- Buttons to save and add member -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <button type="button" id="addMemberBtn" class="btn btn-success">
                                    <i class="fas fa-user-plus"></i> Add Member
                                </button>
                                <a href="EMPLOYEE/group/group-pic" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Current Members -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Current Members</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="currentMembers">
                            <?php foreach ($groupEmployees as $groupEmployee): ?>
                                <?php
                                $employee = $employeeModel->find($groupEmployee['employee_id']);
                                if ($employee):
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $employee['name']; ?>
                                        <a href="<?= site_url('EMPLOYEE/group/edit-group/remove-member/' . $group['id'] . '/' . $employee['id']); ?>"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Click "Remove" to delete members from this group.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // SweetAlert Notification for Flashdata
        const flashSuccess = "<?= session()->getFlashdata('swal_success'); ?>";
        const flashError = "<?= session()->getFlashdata('swal_error'); ?>";

        if (flashSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashSuccess,
                timer: 3000,
                showConfirmButton: false
            });
        }

        if (flashError) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: flashError,
                timer: 3000,
                showConfirmButton: false
            });
        }

        // Add Member Button Click Event
        $('#addMemberBtn').click(function () {
            let groupId = <?= $group['id'] ?>;

            Swal.fire({
                title: 'Add Member',
                input: 'text',
                inputPlaceholder: 'Enter Employee ID',
                showCancelButton: true,
                confirmButtonText: 'Add',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    return value ? null : 'Employee ID is required!';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let employeeId = result.value;

                    $.ajax({
                        url: "<?= site_url('settings/group-setting/add-member') ?>",
                        type: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({ group_id: groupId, employee_id: employeeId }),
                        success: function (response) {
                            if (response.success) {
                                let memberList = $('#currentMembers');
                                let newMember = `
                                    <li class='list-group-item d-flex justify-content-between align-items-center' data-employee-id='${response.employee.id}'>
                                        ${response.employee.name}
                                        <a href="settings/group-setting/remove-member/${groupId}/${response.employee.id}" class="btn btn-danger btn-sm remove-member-btn">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </a>
                                    </li>`;
                                memberList.append(newMember);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message,
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong, please try again.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });

        // Remove Member Confirmation
        $(document).on('click', '.remove-member-btn', function (e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This member will be removed from the group!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });

        // Global SweetAlert for Flashdata
        const flashGeneralSuccess = "<?= session()->getFlashdata('success'); ?>";
        const flashGeneralError = "<?= session()->getFlashdata('error'); ?>";

        if (flashGeneralSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashGeneralSuccess,
                timer: 3000,
                showConfirmButton: false
            });
        }

        if (flashGeneralError) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: flashGeneralError,
                timer: 3000,
                showConfirmButton: false
            });
        }
    });

</script>

<?= $this->endSection(); ?>