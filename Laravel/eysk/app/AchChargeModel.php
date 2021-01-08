<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchChargeModel extends Model
{
    protected $primaryKey = 'ach_charge_id';

    protected $fillable = ['ach_charges_amount', 'start_date','end_date','status','created_by','updated_by'];

    protected $table = 'ach_charges';
}
