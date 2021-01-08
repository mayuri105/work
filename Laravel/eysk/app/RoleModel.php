<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $primaryKey = 'role_id';

    protected $fillable = ['name', 'created_by', 'updated_by'];

    protected $table = 'roles';
}
