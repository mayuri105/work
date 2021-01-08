<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionModel extends Model
{
    protected $primaryKey = 'division_id';

    protected $fillable = ['fk_region_id', 'division_name', 'status','created_by', 'updated_by'];

    protected $table = 'divisions';
}
