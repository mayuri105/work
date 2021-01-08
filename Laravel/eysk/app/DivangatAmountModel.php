<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivangatAmountModel extends Model
{
    protected $primaryKey = 'divangat_amount_id';

    protected $fillable = ['fk_registration_id', 'divangat_amount', 'status', 'created_by','updated_by'];

    protected $table = 'divangat_amounts';
}
