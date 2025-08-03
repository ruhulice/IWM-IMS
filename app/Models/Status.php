<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Status extends Model
{
    use Notifiable;

    protected $table = 'statuses';

    public $timestamps = true;

    protected $fillable = ['name', 'code', 'status', 'created_by', 'updated_by'];

}
