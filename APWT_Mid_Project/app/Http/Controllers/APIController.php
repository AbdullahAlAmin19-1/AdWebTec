<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\vendor;

class APIController extends Controller
{
    //
    function registration(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $s = new Vendor();
        $s->name = $req->name;
        $s->username = $req->username;
        $s->email = $req->email;
        $s->phone = $req->phone;
        $s->password = $req->password;
        $s->gender = $req->gender;
        $s->dob = $req->dob;
        $s->address = $req->address;
        $s->save();
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$s        
            ]
        );
    }

    function user(){
        $data = Vendor::all();

        echo $data;
        // return response()->json($data);
    }
}
