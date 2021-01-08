<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BehalfOfPaymentModel extends Model
{
    protected $primaryKey = 'behalf_of_payments_id';

    protected $fillable = ['behalf_of_payment'];

    protected $table = 'behalf_of_payments';
}
