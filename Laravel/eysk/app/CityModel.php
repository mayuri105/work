<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $primaryKey = 'city_id';

    protected $fillable = ['fk_district_id', 'city_name', 'created_by','updated_by'];

    protected $table = 'cities';
}
