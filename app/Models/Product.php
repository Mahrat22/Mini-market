<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Allow mass-assignment for form create/update
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock',
        'category',
    ];

    // Helpful type casting
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];
}
