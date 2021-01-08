<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllBankEntryModel extends Model
{
    protected $primaryKey = 'all_bank_entry_id';

    protected $fillable = ['payment_date', 'fk_bank_id', 'payment_type', 'ledger_account', 'amount', 'cheque_number', 'transaction_id', 'details', 'payment_mode', 'status', 'created_by', 'updated_by'];

    protected $table = 'all_bank_entry';
}
