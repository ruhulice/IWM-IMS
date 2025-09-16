<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentralICTBudget extends Model
{
    use HasFactory;

    protected $table = 'centralictbudget';

    public $timestamps = false;

    protected $guarded = [];
}
