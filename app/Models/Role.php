<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use Notifiable;

    protected $table = 'roles';

    public $timestamps = true;

    protected $fillable = ['name', 'code', 'authorization', 'is_active', 'status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public static function getAllUserGroupsArray() {
        $items = array();
        foreach (self::where('status_id', 1)->orderBy('id', 'asc')->get() as $item) {
            $items[$item->id] = $item->name;
        }

        return $items;
    }

    public function statusName()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id')->withDefault(Status::class);
    }

    public function menuRole()
    {
        return $this->hasMany(MenuRole::class);
    }

    public function userRole()
    {
        return $this->hasMany(UserRole::class);
    }

    public function rolePermission()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function createdUser()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withDefault(User::class);
    }

    public function updatedUser()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withDefault(User::class);
    }
}
