<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    public $timestamps = true;

    protected $fillable = ['id', 'name', 'created_by', 'updated_by','created_at','updated_at'];
}
