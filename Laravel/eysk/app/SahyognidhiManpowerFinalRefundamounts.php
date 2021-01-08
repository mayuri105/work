<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiManpowerFinalRefundamounts extends Model
{
    protected $primaryKey = 'sahyognidhi_manpower_final_refundamount_id';

    protected $fillable = ['fk_sahyognidhi_manpower_id', 'group1', 'group2', 'group3', 'group4', 'group5', 'group1roudup', 'group2roudup', 'group3roudup', 'group4roudup', 'group5roudup', 'created_by', 'updated_by'];
}
