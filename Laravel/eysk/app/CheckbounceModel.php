<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckbounceModel extends Model
{
    protected $primaryKey = 'checkbounce_id';

    protected $fillable = ['fk_registration_id', 'checkbounce_amount'];

    protected $table = 'checkbounce';
}
