<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APICustomersController extends Controller
{
    function profileinfo()
    {
        // $id = session()->get('id');
        //Get customer id here

        $customer = [];
        $customer = customer::where('id', '=', 1)->first();
        return response()->json($customer, 200);
    }

    function updateprofile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "name" => "required",
            //Others validation here

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $c_id = $req->id;
        $customer = customer::find($c_id);

        $customer->username = $req->username;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->gender = $req->gender;
        $customer->dob = $req->dob;
        $customer->address = $req->address;
        $customer->update();

        return response()->json(
            [
                "msg" => "Updated Successfully",
            ]
        );
    }

    function updatedp(Request $req)
    {

        //Get user id and username here
        //

        $no_id = 1;
        $no_username = "MdRasen";

        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $ppName = $no_username.time().$orgName;
            $req->file->storeAs('public/cprofile_images',$ppName);

            $customer = customer::find($no_id);
            $customer->propic = $ppName;
            $customer->update();
            return response()->json(["msg"=>$ppName]);
        }
        return response()->json(["msg"=>"No file"]);
    }
}
