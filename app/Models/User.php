<?php

namespace App\Models;

use App\Models\Status;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'user_name', 'code', 'email', 'password', 'is_admin', 'user_photo', 'last_login_time', 'last_login_ip', 'status', 'status_id',
        'created_by', 'updated_by' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function role()
    {
        return $this->hasMany(UserRole::class);
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            foreach($roles as $need_role) {
                if($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function checkIfUserHasRole($need_role)
    {
        foreach($this->role as $u_role) {
            if(strtolower($need_role) == str_replace(' ', '', strtolower($u_role->role->name))) {
                return true;
            }
        }
    }

    public function statusName()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id')->withDefault(Status::class);
    }
}
