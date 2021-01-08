<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LockingPeriodModel extends Model
{
    protected $primaryKey = 'locking_period_id';

    protected $fillable = ['start_date', 'end_date', 'locking_days', 'disease_days', 'status', 'created_by','updated_by'];

    protected $table = 'locking_periods';
}
