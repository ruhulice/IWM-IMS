<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionDetails extends Model
{
    use HasFactory;
    protected $table = 'requisitiondetails';

    public $timestamps = false;

   // protected $guarded = [];
   protected $fillable = [
        'requisitionid',
        'categoryid',
        'subcategoryid',
        'techspecification',
        'quantity',
        'uom',
        'rate',
        'price',
    ];
}
