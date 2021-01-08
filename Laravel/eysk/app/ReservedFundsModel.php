<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservedFundsModel extends Model
{
    protected $primaryKey = 'reserved_fund_id';

    protected $fillable = ['percentage', 'start_date', 'end_date', 'status', 'created_by', 'updated_by'];

    protected $table = 'reserved_funds';
}
