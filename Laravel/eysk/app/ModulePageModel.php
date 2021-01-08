<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePageModel extends Model
{
    protected $primaryKey = 'page_id';

    protected $fillable = ['fk_module_id', 'parent_page_id','page_title','page_description','page_slug','page_icon','page_url','is_menu','status'];

    protected $table = 'module_pages';
}
