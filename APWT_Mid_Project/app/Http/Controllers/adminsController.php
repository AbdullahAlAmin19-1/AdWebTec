<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use Illuminate\Support\Facades\DB;
Use App\Rules\MatchOldPassword;

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
            "dob" => "required|before:-14 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 14 years or older.',
        ]
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
    function changepassword(Request $vali){
        return view("admin.achangepassword");
    }
    function changepasswordupdate(Request $vali){
        $this->validate($vali,
            [
                "cur_pass"=>['required', new MatchOldPassword],
                "new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
            ],
            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        // $user=admin::where('id','=',session()->get('id'))->first();
        // $user->password = $vali->conf_new_pass;
        // $user->update();
        // session()->put('username', $user->username);
        
        $user= admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        // dd('Password change successfully.')
        session()->flash('msg','Password Changed');
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

    function aviewcustomer(){

        $user = DB::table('customers')->simplePaginate(15);
        return view('admin.aviewcustomer', compact('user'));
    }
    function customerremove($id){

        $user = customer::where('id', $id)->delete();
        session()->flash('customerRemove', "Customer has been removed!");
        return redirect()->route('admin.aviewcustomer');
    }
    function searchcustomer(Request $req){

        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    $customers= customer::where('name', 'like', '%'.$search_name.'%')->get();
    return view("admin.asearchcustomer")->with('customers', $customers);
    }

    function aviewdeliveryman(){

        $user = DB::table('deliverymen')->simplePaginate(15);
        return view('admin.aviewdeliveryman', compact('user'));
    }
    function deliverymanremove($id){

        $user =DB::delete('delete from deliverymen where id = ?',[$id]);
        session()->flash('deliverymanRemove', "Deliveryman has been removed!");
        return redirect()->route('admin.aviewdeliveryman');
    }
    function searchdeliveryman(Request $req){

        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    //$deliverymen = DB::select('select * from deliverymen where name ');
    $deliverymen = deliveryman::where('name', 'like', '%'.$search_name.'%')->get();
    return view("admin.asearchdeliverymen")->with('customers', $customers);
    }
    function aviewvendor(){

        $user = DB::table('vendors')->simplePaginate(5);
        return view('admin.aviewvendor', compact('user'));
    }
}
