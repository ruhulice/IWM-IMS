<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFile extends Model
{
    public $timestamps = true;

    protected $fillable = ['id', 'document_id','file_name','doc_link','thumb_image_link','created_by', 'updated_by','created_at','updated_at','is_active'];


    public function docInfo()
    {
        return $this->belongsTo('App\Models\Document', 'document_id', 'id')->withDefault(Document::class);
    }
}
