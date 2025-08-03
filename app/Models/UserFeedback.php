<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    protected $table = 'user_feedbacks';

    protected $fillable = ['plot_no', 'division', 'district', 'upazilla', 'mouza_code', 'geocode', 'orginal_land_use', 'land_use_feedback', 'feedback_remarks', 'admin_comments', 'is_resolved', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
