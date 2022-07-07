<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Vendor;

class Product extends Model
{
    use HasFactory;
    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }
    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_products','p_id','c_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function vendors()
    {
        return $this->belongsTo(Vendor::class);
    }
}
