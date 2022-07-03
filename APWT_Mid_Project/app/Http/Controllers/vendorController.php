<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    // function welcome(){return view("public.welcome");}
    public function dashboard()
    {
        $p=product::where('v_id','=',session()->get('id'))->paginate(4);
        return view('vendor.dashboard', compact('p'));
    }
    function profile(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.profile")->with('vendor',$user);}
        else {return view("vendor.dashboard");}
    }
    function editprofile(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.editprofile")->with('vendor',$user);}
        else {return view("vendor.dashboard");}
    }
    function editprofileupdate(Request $vali){
        $this->validate($vali, [
            "username" => "required",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email",
            "phone" => "required|max:10|min:10",
            "password" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "gender" => "required",
            "dob" => "required",
            "address" => "required"
        ],
        []
        );
        $user=vendor::where('id','=',session()->get('id'))->first();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->password = $vali->password;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->put('user_name', $user->username);
        session()->flash('msg','Update Completed');
        return back();
    }
    function picupload(Request $req){
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

        $req->file('pic')->storeAs('public/vendor_profile_images', $picname);

       
        $user = vendor::find($id);
        $user->propic = $picname;
        $user->update();

        session()->flash('msg','profile picture has been successfully updated!');
        return redirect()->route('vendor.editprofile');
    }    
    function addproduct(){return view("vendor.addproduct");}
    function addproductConfirm(Request $vali){
        $this->validate($vali, [
            "name" => "required",
            "category" => "required",
            "thumbnail" => "required",
            "price" => "required",
            "stock" => "required",
        ],
        []
        );
        $p=new product();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $p->p_name = $vali->name;
        $p->p_category = $vali->category;
        $p->p_thumbnail = $vali->thumbnail;
        $p->p_gallery = $vali->gallery;
        $p->p_price = $vali->price;
        $p->p_stock = $vali->stock;
        $p->p_color = $vali->color;
        $p->p_size = $vali->size;
        $p->p_description = $vali->description;
        $p->v_id = Session()->get('id');
        $p->save();
        session()->flash('msg','Product Added');
        return back();
    }
    function editproduct($p_id){
        // $p = product::find($p_id);
        $p = product::where('p_id','=',$p_id)->first();
        if($p){return view("vendor.editProduct")->with('p',$p);}
        else {return view("vendor.dashboard");}
    }
    function editproductConfirm(){
    }
    function deleteproduct($p_id){
        // $p = product::find($p_id);
        $p = product::where('p_id','=',$p_id)->first();
        if($p){return view("vendor.deleteproduct")->with('product',$p);}
        else {return view("vendor.dashboard");}
    }
    function deleteproductConfirm($p_id){
        DB::delete('delete from products where p_id = ?',[$p_id]);
        $p = product::where('p_id','=',$p_id)->first();
        if($p){
            session()->flash('msg','Product Id '.$p_id.' Deletion Failed');
            return redirect()->route("vendor.dashboard");
        }
        else {
            session()->flash('msg','Product Id '.$p_id.' Deletion Successful');
            return redirect()->route("vendor.dashboard");
        }
    }
}
