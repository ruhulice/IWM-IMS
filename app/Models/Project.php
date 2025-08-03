<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use Notifiable;

    protected $table = 'project';

    public $timestamps = true;

    protected $guarded = [];

    // protected $fillable = ['title', 'code', 'project_no', 'assign_ps_name', 'assign_pl_name', 'client_name', 'client_org_name', 'submission_type_name', 'submission_date', 'association', 
    // 'partner_jv_share', 'share', 'budget', 'tech_score', 'fin_score', 'total_score', 'remarks', 'attach_file', 'attach_photo', 'request_ip', 'status', 'status_id', 'created_by', 'updated_by'];

    // public function statusName()
    // {
    //     return $this->belongsTo('App\Models\Status', 'status_id', 'id')->withDefault(Status::class);
    // }

    // public function createdUser()
    // {
    //     return $this->belongsTo('App\Models\User', 'created_by', 'id')->withDefault(User::class);
    // }

    // public function updatedUser()
    // {
    //     return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withDefault(User::class);
    // }
}
