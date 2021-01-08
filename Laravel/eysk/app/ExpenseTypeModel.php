<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseTypeModel extends Model
{
    protected $primaryKey = 'expense_type_id';

    protected $fillable = ['expense_type', 'status', 'created_by','updated_by'];

    protected $table = 'expense_types';
}
