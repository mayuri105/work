<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleModel extends Model
{
    protected $primaryKey = 'module_id';

    protected $fillable = ['name', 'status'];

    protected $table = 'modules';
}
