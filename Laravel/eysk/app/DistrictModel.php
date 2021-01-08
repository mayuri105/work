<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    protected $primaryKey = 'district_id';

    protected $fillable = ['district_name', 'district_code', 'status', 'created_by','updated_by'];

    protected $table = 'districts';
}
