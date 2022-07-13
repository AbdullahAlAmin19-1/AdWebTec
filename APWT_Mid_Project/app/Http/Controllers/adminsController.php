<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\req_deliveryman;
use Illuminate\Support\Facades\DB;

class adminsController extends Controller
{
    //
    function __construct(){
        $this->middleware("logged");
        $this->middleware("admin");
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
        $id = session()->get('id');
        $this->validate($vali, [
            "username" => "required|unique:admins,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:admins,email,$id",
            "phone"=>"required|numeric|digits:10",
            "gender" => "required",
            "dob" => "required|before:-18 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 18 years or older.',
        ]
    );
        $user=admin::where('id','=',session()->get('id'))->first();
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
                "cur_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
            ],
            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user->password == $vali->cur_pass){
            $user->password = $vali->new_pass;
            $user->update();
            session()->flash('msg','Password Update Completed');
            return redirect()->route('admin.aprofile');
        }
        else {
            session()->flash('msg',"Current Password Dosen't Match");
            return back();
        }
        
        
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
    function editcustomer($id){
        $user = customer::where('id', $id)->first();
        return view("admin.aeditcustomer")->with('customer',$user);
    }
    function editcustomerupdate(Request $vali){
        $this->validate($vali, [
            "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "gender" => "required",
            "dob" => "required|before:-10 years",
            "address" => "required"
        ],
        []
    );
        $user = customer::find($vali->id);
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->flash('msg','Update Completed');
        return back();
    }
    function customerppupload(Request $req){

        $this->validate($req, [
            "myPP" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'myPP.required' => 'Please select a picture!',
            'myPP.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $customer = customer::find($req->id);
        $extension = $req->file('myPP')->getClientOriginalExtension();
        $picname = $customer->name.time().".".$extension;
        $req->file('myPP')->storeAs('public/cprofile_images', $picname);
        $customer->prpopic = $picname;
        $customer->update();

        session()->flash('msg','Customer profile picture has been successfully updated!');
        return back();
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
    $deliverymen = deliveryman::where('name', 'like', '%'.$search_name.'%')->get();
    return view("admin.asearchdeliveryman")->with('deliverymen', $deliverymen);
    }
    function editdeliveryman($id){
        $user = deliveryman::where('id', $id)->first();
        return view("admin.aeditdeliveryman")->with('deliveryman',$user);
    }
    function editdeliverymanupdate(Request $vali){
        $this->validate($vali, [
            "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "gender" => "required",
            "dob" => "required|before:-16 years",
            "address" => "required"
        ],
        []
    );
        $user = deliveryman::find($vali->id);
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->flash('msg','Update Completed');
        return back();
    }
    function deliverymanppupload(Request $req){

        $this->validate($req, [
            "pic" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'pic.required' => 'Please select a picture!',
            'pic.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $deliveryman = deliveryman::find($req->id);
        $extension = $req->file('pic')->getClientOriginalExtension();
        $picname = $deliveryman->name.time().".".$extension;
        $req->file('pic')->storeAs('public/dprofile_images', $picname);
        $deliveryman->propic = $picname;
        $deliveryman->update();

        session()->flash('msg','deliveryman profile picture has been successfully updated!');
        return back();
    }

    function aaprovedeliveryman(){
        $user = DB::table('req_deliverymen')->simplePaginate(15);
        return view('admin.aaprovedeliveryman', compact('user'));
    }
    function adddeliveryman($id){

        $del = req_deliveryman::where('id', $id)->first();

        $user = new deliveryman();
        $user->name = $del->name;
        $user->username = $del->username;
        $user->email =$del->email;
        $user->phone = $del->phone;
        $user->password = $del->password;
        $user->gender = $del->gender;
        $user->dob = $del->dob;
        $user->address = $del->address;
        $user->save();
        $del =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        session()->flash('adddeliveryman', "Deliveryman has been added!");
        // session()->flash('msg','Registration Completed!');
        return back();
    }
    function canceldeliveryman($id){
        $del =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        session()->flash('adddeliveryman', "Deliveryman request has been cancelled!");
        // session()->flash('msg','Registration Completed!');
        return back();
    }

    function aviewvendor(){

        $user = DB::table('vendors')->simplePaginate(5);
        return view('admin.aviewvendor', compact('user'));
    }
}
