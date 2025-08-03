<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['cmnt', 'status', 'user_id', 'progress'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
