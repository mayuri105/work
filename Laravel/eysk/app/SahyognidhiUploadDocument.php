<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SahyognidhiUploadDocument extends Model
{
    protected $primaryKey = 'sahyognidhi_upload_document_id';

    protected $fillable = ['fk_sahyognidhi_id', 'sahyognidhi_type', 'upload_document_status', 'upload_document', 'document_extension', 'status', 'created_by', 'updated_by'];

    protected $table = 'sahyognidhi_upload_documents';
}
