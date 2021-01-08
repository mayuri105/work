<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixDepositDetailModel extends Model
{
    protected $primaryKey = 'fix_deposit_detail_id';

    protected $fillable = ['fk_fix_deposit_id', 'fd_certificate_no', 'fd_amount', 'fd_percentage', 'fd_maturity_date', 'fd_maturity_amount', 'narration', 'created_by', 'updated_by'];

    protected $table = 'fix_deposit_detail';
}
