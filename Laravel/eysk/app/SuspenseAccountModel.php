<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuspenseAccountModel extends Model
{
    protected $primaryKey = 'suspense_account_id';

    protected $fillable = ['fk_bank_id', 'payment_type', 'date', 'amount', 'cheque_number', 'transaction_id', 'details', 'payment_mode', 'status', 'created_by', 'updated_by'];

    protected $table = 'suspense_accounts';
}
