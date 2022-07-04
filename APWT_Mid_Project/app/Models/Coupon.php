<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_coupon','c_id','co_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'co_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
