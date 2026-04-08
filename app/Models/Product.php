<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'discount',
        'is_active',
        'colors',
        'image',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'discount' => 'integer',
        'is_active' => 'boolean',
        'colors' => 'array',
    ];
}
