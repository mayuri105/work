<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermissionModel extends Model
{
    protected $primaryKey = 'role_permissions_id';

    protected $fillable = ['fk_role_id', 'fk_page_id','created_by','updated_by'];

    protected $table = 'role_permissions';
}
