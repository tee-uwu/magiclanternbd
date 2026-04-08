<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'product',
        'color',
        'quantity',
        'delivery_area',
        'delivery_charge',
        'total_price',
        'status',
    ];
}