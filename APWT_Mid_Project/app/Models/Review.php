<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Customer;

class review extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $with = ['customer'];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id');
    }

    protected $with = ['product'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'p_id');
    }

}
