<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomineeDetailsModel extends Model
{
    protected $primaryKey = 'nominee_details_id';

    protected $fillable = ['fk_registration_id', 'first_nominee_family_id', 'first_nominee_member_id', 'first_nominee_name','first_nominee_relation', 'second_nominee_family_id', 'second_nominee_member_id', 'second_nominee_name', 'second_nominee_relation', 'fk_registration_default_status', 'created_by','updated_by'];

    protected $table = 'nominee_details';
}
