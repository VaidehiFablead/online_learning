<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
     protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'enrollment_id',
        'stripe_id',
        'amount',
        'currency',
        'status',
        'created_at'
    ];
}
