<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    protected $primaryKey = 'group_id';

    protected $fillable = ['group_sheet', 'group_name', 'fk_group_id', 'group_division', 'group_type', 'status', 'created_by','updated_by'];

    protected $table = 'groups';
}
