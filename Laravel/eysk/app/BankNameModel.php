<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankNameModel extends Model
{
    protected $primaryKey = 'bank_name_id';

    protected $fillable = ['bank_name', 'status','created_by','updated_by'];

    protected $table = 'bank_names';
}
