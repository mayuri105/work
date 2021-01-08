<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucherModel extends Model
{
    protected $primaryKey = 'journal_voucher_id';

    protected $fillable = ['date', 'journal_voucher_no', 'fk_ledger_account_id_main', 'transaction_type_main', 'amount_main', 'narration_main', 'created_by', 'updated_by', 'type_account_main'];

    protected $table = 'journal_voucher';
}
