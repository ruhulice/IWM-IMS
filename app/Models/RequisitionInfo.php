<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionInfo extends Model
{
    use HasFactory;
    protected $table = 'requisitioninfo';

    public $timestamps = false;

    protected $guarded = [];
    // protected $fillable = [
    //     'requisitiondate',
    //     'requisitionby',
    //     'status',
    //     'divisionid',
    //     'projectno',
    //     'totalamount',
    //     'reqpurpose',
    //     'created_at'
    // ];
}
