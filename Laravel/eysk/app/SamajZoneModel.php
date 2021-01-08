<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SamajZoneModel extends Model
{
    protected $primaryKey = 'samaj_zone_id';

    protected $fillable = ['fk_region_id', 'samaj_zone_name', 'samaj_zone_code', 'status', 'created_by','updated_by'];

    protected $table = 'samaj_zones';
}
