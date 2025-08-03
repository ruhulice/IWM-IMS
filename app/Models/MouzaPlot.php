<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MouzaPlot extends Model
{
    use Notifiable;

    protected $table = 'uploaded_mouza';

    public $timestamps = true;

    protected $fillable = ['div_code', 'dist_code', 'upz_code', 'uni_code','mouza_code','shape_file_path','table_name','status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];


    // public static function getAllUserGroupsArray() {
    //     $items = array();
    //     foreach (self::where('status_id', 1)->orderBy('id', 'asc')->get() as $item) {
    //         $items[$item->id] = $item->name;
    //     }

    //     return $items;
    // }

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
