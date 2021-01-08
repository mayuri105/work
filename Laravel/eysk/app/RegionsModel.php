<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionsModel extends Model
{
    protected $primaryKey = 'region_id';

    protected $fillable = ['region_name', 'region_code', 'status', 'created_by','updated_by'];

    protected $table = 'regions';
}
