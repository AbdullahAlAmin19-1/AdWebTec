<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function order()
    {
        return $this->belongsTo(oder::class);
    }
}
