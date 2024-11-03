<?php

namespace App\Models\Order;

use App\Models\Product\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'productID');
    }
}
