<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white text-center">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle"></i> Add New Invoice
                </h3>
            </div>

            <!-- Hidden Identifiers -->
            <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
            <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

            <div class="card-body">
                <form action="<?= base_url('DOCUMENTATION IT/invoice/save'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <!-- Vendor -->
                        <div class="col-md-6 mb-3">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <select class="form-control" id="vendor_id" name="vendor_id" required>
                                <option value="" disabled selected>-- Select Vendor --</option>
                                <?php foreach ($vendors as $vendor): ?>
                                    <option value="<?= esc($vendor['id']) ?>"><?= esc($vendor['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Description -->
<div class="col-md-6 mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter invoice description"></textarea>
</div>

                        <!-- Invoice Date -->
                        <div class="col-md-6 mb-3">
                            <label for="invoice_date" class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Due Date -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <!-- Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                placeholder="Enter invoice amount" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="unpaid" readonly>
                        </div>
                    </div>

                    <!-- Buttons: Add and Cancel -->
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-warning px-4" style="margin-right: 15px;">
                            <i class="fas fa-paper-plane me-2"></i> Add
                        </button>
                        <a href="<?= base_url('DOCUMENTATION IT/invoice/bill') ?>" class="btn btn-danger px-4"
                            style="margin-left: 15px;">
                            <i class="fas fa-times-circle me-2"></i> Cancel
                        </a>
                    </div>
                </form>
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- container-fluid -->
</div> <!-- content-wrapper -->

<?= $this->endSection(); ?>