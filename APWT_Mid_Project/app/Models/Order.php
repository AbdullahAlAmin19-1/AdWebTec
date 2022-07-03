<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vendor;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Deliveryman;

class order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class);
    }
}
