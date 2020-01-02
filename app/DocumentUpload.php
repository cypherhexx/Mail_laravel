<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentUpload extends Model
{

	use SoftDeletes;

    protected $table="document_upload";

     protected $fillable=['file_title','name'];
}
