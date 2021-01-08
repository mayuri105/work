<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixDepositModel extends Model
{
    protected $primaryKey = 'fix_deposit_id';

    protected $fillable = ['date', 'fix_deposit_no', 'fk_ledger_account_id', 'amount_main', 'created_by', 'updated_by'];

    protected $table = 'fix_deposit';
}
