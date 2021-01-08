<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeTypeModel extends Model
{
    protected $primaryKey = 'income_type_id';

    protected $fillable = ['income_type', 'status', 'created_by','updated_by'];

    protected $table = 'income_types';
}
