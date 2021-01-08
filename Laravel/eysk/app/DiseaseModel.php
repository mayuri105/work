<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseModel extends Model
{
    protected $primaryKey = 'disease_id';

    protected $fillable = ['disease_name', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $table = 'diseases';
}
