<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LedgerAccountModel extends Model
{
    protected $primaryKey = 'ledger_account_id';

    protected $fillable = ['ledger_account_id', 'legder_name', 'fk_group_id', 'status', 'created_by', 'updated_by'];

    protected $table = 'ledger_accounts';
}
