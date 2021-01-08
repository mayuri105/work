<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiAmountModel extends Model
{
    protected $primaryKey = 'sahyognidhi_amount_id';

    protected $fillable = ['start_date','end_date', 'full_disability_percentage', 'half_disability_percentage', 'divangate_amount', 'status','created_by','updated_by'];

    protected $table = 'sahyognidhi_amount';
}
