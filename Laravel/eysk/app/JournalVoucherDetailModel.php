<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucherDetailModel extends Model
{
    protected $primaryKey = 'journal_voucher_detail_id';

    protected $fillable = ['fk_payment_id', 'fk_journal_voucher_id', 'transaction_type', 'amount', 'narration', 'created_by', 'updated_by', 'type_account'];

    protected $table = 'journal_voucher_detail';
}
