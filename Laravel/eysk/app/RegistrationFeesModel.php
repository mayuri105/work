<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationFeesModel extends Model
{
    protected $primaryKey = 'registration_fees_id';

    protected $fillable = ['start_date', 'end_date', 'start_age1', 'end_age1', 'fees_amount1','start_age2','end_age2','fees_amount2','start_age3','end_age3','fees_amount3','start_age4','end_age4','fees_amount4','status','created_by','updated_by'];

    protected $table = 'registration_fees';
}
