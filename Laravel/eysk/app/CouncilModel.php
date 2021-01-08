<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouncilModel extends Model
{
    protected $primaryKey = 'council_id';

    protected $fillable = ['name', 'code', 'fk_region', 'created_by', 'updated_by'];

    protected $table = 'councils';
}
