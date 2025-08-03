<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table = 'menu_roles';

    protected $fillable = ['menu_id', 'role_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
