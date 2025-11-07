<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white text-center">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Invoice</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('DOCUMENTATION IT/invoice/update/' . $invoice['id']); ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <!-- Vendor (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <?php
                            $vendorName = '';
                            foreach ($vendors as $vendor) {
                                if ($vendor['id'] == $invoice['vendor_id']) {
                                    $vendorName = $vendor['name'];
                                    break;
                                }
                            }
                            ?>
                            <input type="text" class="form-control" value="<?= esc($vendorName) ?>" readonly>
                            <input type="hidden" name="vendor_id" value="<?= esc($invoice['vendor_id']) ?>">
                        </div>

                        <!-- Invoice Date (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label for="invoice_date" class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                                value="<?= esc($invoice['invoice_date']) ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Due Date (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                value="<?= esc($invoice['due_date']) ?>" readonly>
                        </div>

                        <!-- Amount (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="<?= esc($invoice['amount']) ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Payment Date (editable) -->
                        <div class="col-md-6 mb-3">
                            <label for="payment_date" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                value="<?= esc($invoice['payment_date']) ?>">
                        </div>

                        <!-- Status (editable) -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="paid" <?= $invoice['status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                                <option value="late" <?= $invoice['status'] == 'late' ? 'selected' : '' ?>>Late</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center" style="gap: 20px;">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="<?= base_url('DOCUMENTATION IT/invoice/bill') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>