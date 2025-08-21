<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSInfo extends Model
{
    use HasFactory;
    protected $table = 'csinfo';
    public $timestamps = false;
    protected $guarded = [];
}
