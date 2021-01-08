<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptDetailModel extends Model
{
    protected $primaryKey = 'receipt_detail_id';

    protected $fillable = ['fk_receipt_id', 'fk_ledger_account_id', 'transaction_type', 'amount', 'narration', 'created_by', 'updated_by'];

    protected $table = 'receipt_detail';
}
