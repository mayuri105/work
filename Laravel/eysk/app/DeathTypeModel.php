<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeathTypeModel extends Model
{
    protected $primaryKey = 'death_type_id';

    protected $fillable = ['title', 'description','status','created_by','updated_by'];

    protected $table = 'death_types';
}
