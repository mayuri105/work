<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YuvaMandalNumberModel extends Model
{
    protected $primaryKey = 'yuva_mandal_number_id';

    protected $fillable = ['fk_region_id', 'fk_samaj_zone_id', 'division_name', 'yuva_mandal_number', 'yuva_mandal_code', 'status', 'created_by','updated_by'];

    protected $table = 'yuva_mandal_numbers';
}
