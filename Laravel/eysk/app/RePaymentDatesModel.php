<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RePaymentDatesModel extends Model
{
    protected $primaryKey = 're_payment_date_id';

    protected $fillable = ['re_payment_date', 'status', 'created_by', 'updated_by'];

    protected $table = 're_payment_dates';
}
