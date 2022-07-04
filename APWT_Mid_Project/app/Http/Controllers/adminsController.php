<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class adminsController extends Controller
{
    //
    function __construct(){
        $this->middleware("logged");
    }
    
    function welcome(){
        return view("public.welcome");
    }

    function adashboard(){
        return view("admin.adashboard");
    }
    
    function aprofile(){
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user){return view("admin.aprofile")->with('admin',$user);}
        else {return view("admin.adashboard");}
    }

    function aeditprofile(){
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user){return view("admin.aeditprofile")->with('admin',$user);}
        else {return view("admin.adashboard");}
    }
    function aeditprofileupdate(Request $vali){
        $this->validate($vali, [
            "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "gender" => "required",
            "dob" => "required",
            "address" => "required"
        ],
        []
    );
        $user=admin::where('id','=',session()->get('id'))->first();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->put('username', $user->username);
        session()->flash('msg','Update Completed');
        return redirect()->route('admin.aprofile');
    }
    function apicupload(Request $req){
        $this->validate($req, [
            "pic" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'pic.required' => 'Please select a picture!',
            'pic.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
        );
        $id = session()->get('id');
        $username = session()->get('username');

        $extension = $req->file('pic')->getClientOriginalExtension();

        $picname = $username.time().".".$extension;

        $req->file('pic')->storeAs('public/admin_profile_images', $picname);

       
        $user = admin::find($id);
        $user->propic = $picname;
        $user->update();

        session()->flash('msg','Profile picture has been successfully updated!');
        return redirect()->route('admin.aprofile');
    }
}
