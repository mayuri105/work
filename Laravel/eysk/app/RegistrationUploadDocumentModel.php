<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationUploadDocumentModel extends Model
{
    protected $primaryKey = 'registration_document_id';

    protected $fillable = ['fk_registration_id', 'upload_registration_documnet_status', 'upload_registration_document', 'upload_document_extension', 'status','created_by','updated_by'];

    protected $table = 'registration_upload_documents';
}
