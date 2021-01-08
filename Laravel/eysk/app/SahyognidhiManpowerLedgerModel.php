<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiManpowerLedgerModel extends Model
{
    protected $primaryKey = 'fk_sahyognidhi_ledger_account_id';
    protected $fillable = ['fk_sahyognidhi_manpower_id', 'fk_ledger_account_id', 'reduct_amount', 'status','created_by','updated_by'];
    protected $table = 'sahyognidhi_manpower_ledger_account';
}
