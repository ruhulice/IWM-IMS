<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalFlow extends Model
{
    use HasFactory;

    protected $table = 'approvalflow';

    public $timestamps = false;

    protected $guarded = [];
}
