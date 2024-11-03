<?php

namespace App\Models\Order;

use App\Models\Buyers;
use App\Observers\Admin\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::observe(new OrderObserver);
    }

    public function buyer()
    {
        return $this->hasOne(Buyers::class, 'id', 'userID');
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'orderID', 'id');
    }
}
