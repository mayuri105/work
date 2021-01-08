<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRegistrationDocumentUploadModel extends Model
{
    protected $primaryKey = 'employee_registration_document_upload_id';

    protected $fillable = ['fk_employee_id', 'document_upload_status', 'document_upload', 'upload_document_extension', 'status', 'created_by', 'updated_by'];

    protected $table = 'employee_registration_document_uploads';
}
