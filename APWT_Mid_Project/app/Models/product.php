<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $guarded = [];

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

=======
    protected $primarykey = "p_id";
>>>>>>> 032a230a012ffdf693d415f54846f1a72864cf03
}
