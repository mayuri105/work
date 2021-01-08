<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = ['date', 'payment_no', 'fk_ledger_account_id_main', 'transaction_type_main', 'amount_main', 'narration_main', 'created_by', 'updated_by', 'type_account_main'];

    protected $table = 'payment';
}
