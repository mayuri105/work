<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetailModel extends Model
{
    protected $primaryKey = 'payment_detail_id';

    protected $fillable = ['fk_payment_id', 'fk_ledger_account_id', 'transaction_type', 'amount', 'narration', 'created_by', 'updated_by', 'type_account'];

    protected $table = 'payment_detail';
}
