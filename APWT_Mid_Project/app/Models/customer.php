<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Deliveryman;

class customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function deliverymen()
    {
        return $this->belongsToMany(Deliveryman::class);
    }
}
