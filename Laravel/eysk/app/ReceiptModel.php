<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptModel extends Model
{
    protected $primaryKey = 'receipt_id';

    protected $fillable = ['date', 'receipt_voucher_no', 'fk_ledger_account_id_main', 'transaction_type_main', 'amount_main', 'narration_main', 'created_by', 'updated_by'];

    protected $table = 'receipt';
}
