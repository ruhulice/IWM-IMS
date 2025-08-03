<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsConfiguration extends Model
{
    protected $table = 'sms_configurations';

    protected $fillable = ['feedback_sms', 'created_by', 'updated_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
