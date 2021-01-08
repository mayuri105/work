<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierSlipModel extends Model
{
    protected $primaryKey = 'courier_slip_id';

    protected $fillable = ['fk_courier_id', 'upload_document_extension', 'upload_courier_slip', 'created_by', 'updated_by'];

    protected $table = 'courier_slips';
}
