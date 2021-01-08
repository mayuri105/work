<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankChargesModel extends Model
{
    protected $primaryKey = 'bank_charges_id';

    protected $fillable = ['bank_charges_amount', 'start_date','end_date','status','created_by','updated_by'];

    protected $table = 'bank_charges';
}
