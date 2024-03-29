<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_coupon extends Model
{
    use HasFactory;

    protected $with = ['coupon'];
    public function coupon()
    {
        return $this->belongsTo(coupon::class, 'co_id');
    }
}
