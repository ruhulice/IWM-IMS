<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['notification_title', 'notification_details', 'action', 'is_seen', 'to_user', 'seen_time', 'created_by'];

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
