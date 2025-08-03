<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = true;

    protected $fillable = ['id', 'title','description','doc_type','ref_no','client','date','subject','to_whome','from','doc_link','thumb_image_link','remarks','prepared_by', 'created_by', 'updated_by','created_at','updated_at','is_active'];


    public function docTypeName()
    {
        return $this->belongsTo('App\Models\DocType', 'doc_type', 'id')->withDefault(DocType::class);
    }

    public function documentfile()
    {
        return $this->hasMany(DocumentFile::class);
    }
}
