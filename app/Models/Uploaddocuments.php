<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploaddocuments extends Model
{
    use HasFactory;
    
   protected $table = 'uploaddocuments';

    public $timestamps = false;

    //protected $guarded = [];
    protected $fillable = [
        'name',
        'path',
        'documenttype',
        'documentid',
        'uploadby',
        'uploaddate'

    ];
}
