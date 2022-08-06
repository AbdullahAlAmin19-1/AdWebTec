<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\vendor;
use App\Models\req_deliveryman;
use App\Models\notice;
use App\Models\order;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\requested_coupon;
use App\Models\customer_product;
use App\Models\customer_coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class APIAdminController extends Controller
{
    function profileinfo()
    {
        // $id = session()->get('id');
        //Get customer id here

        $admin = [];
        $admin = admin::where('id', '=', 1)->first();
        return response()->json($admin, 200);
    }
}
