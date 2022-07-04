<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_products','c_id','p_id');
    }
}
