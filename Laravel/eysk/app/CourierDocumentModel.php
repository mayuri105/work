<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierDocumentModel extends Model
{
    protected $primaryKey = 'document_id';

    protected $fillable = ['document_title'];

    protected $table = 'courier_documents';
}
