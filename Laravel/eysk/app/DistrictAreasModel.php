<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictAreasModel extends Model
{
    protected $primaryKey = 'area_id';

    protected $fillable = ['fk_district_id','area_name', 'status','created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $table = 'district_areas';
}
