<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetailsModel extends Model
{
    protected $primaryKey = 'bank_detail_id';

    protected $fillable = ['fk_bank_name', 'bank_account_type','bank_branch','bank_account_number','bank_ifsc_code','status','created_by','updated_by'];

    protected $table = 'bank_details';
}
