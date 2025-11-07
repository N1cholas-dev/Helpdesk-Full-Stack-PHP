<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'vendor_id',
        'description',
        'invoice_date',
        'due_date',
        'amount',
        'status',
        'payment_date'
    ];

    
}
