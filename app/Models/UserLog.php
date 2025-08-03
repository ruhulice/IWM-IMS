<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';

    public $timestamps = false;

    protected $fillable = ['log_type', 'work_area', 'description', 'tbl_name', 'tbl_id', 'ip_address', 'created_at', 'created_by', 'status'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
