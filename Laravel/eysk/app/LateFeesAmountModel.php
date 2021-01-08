<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LateFeesAmountModel extends Model
{
    protected $primaryKey = 'late_fees_amount_id';

    protected $fillable = ['start_date', 'end_date', 'late_fees_days', 'late_fees_charges', 'grace_days', 'grace_period_charges', 'status','created_by','updated_by'];

    protected $table = 'late_fees_amounts';
}
