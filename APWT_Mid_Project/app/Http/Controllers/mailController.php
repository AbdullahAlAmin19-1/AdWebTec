<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\req_deliveryman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\approveDeliveryman;

class mailController extends Controller
{
    function approvedeliverymanMail($id){

        $del = deliveryman::where('id', $id)->first();

        // Mail::to("arbhoa1@gmail.com")->send(new approveDeliveryman("Your request of deliveryman job has been confirmed!",$del->username));

        Mail::to([$del->email])->send(new approveDeliveryman("Your request of deliveryman job has been confirmed!",$del));

        session()->flash('adddeliveryman', "Deliveryman has been added!");
        return redirect()->route('admin.aaprovedeliveryman');
    }
}
