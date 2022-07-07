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
        $p=product::where('v_id','=',session()->get('id'))->simplePaginate(4);
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
        session()->put('username', $user->username);
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
            "p_thumbnail" => "required|mimes:jpg,png,jpeg",
            "price" => "required",
            "stock" => "required",
        ],
        [
            'p_thumbnail.required' => 'Please select a picture!',
            'p_thumbnail.mimes' => 'Product Thumbnail must be a jpg, png or jpeg!',
        ]
        );

        $productname = $vali->name;
        $extension = $vali->file('p_thumbnail')->getClientOriginalExtension();
        $thumbnailname = $productname.time().".".$extension;

        echo $thumbnailname;

        $vali->file('p_thumbnail')->storeAs('public/product_images', $thumbnailname);

        $p=new product();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->thumbnail = $thumbnailname;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->v_id = Session()->get('id');
        $p->save();
        session()->flash('msg','Product Added');
        return back();
    }
    function editproduct($id){
        // $p = product::find($id);
        $p = product::where('id','=',$id)->first();
        if($p){return view("vendor.editProduct")->with('p',$p);}
        else {return view("vendor.dashboard");}
    }
    function editproductConfirm(Request $vali){
        $this->validate($vali, [
            "name" => "required",
            "category" => "required",
            "thumbnail" => "required",
            "price" => "required",
            "stock" => "required",
        ],
        []
        );
        //$p = product::where('p_id','=',$vali->id)->first();

        $p = product::find($vali->id);
        $p->id = $vali->id;
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->thumbnail = $vali->thumbnail;
        // $p->gallery = $vali->gallery;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->v_id = $vali->v_id;
        $p->update();
        session()->flash('msg','Product Updated');
        return back();
    }
    function deleteproduct($id){
        // $p = product::find($p_id);
        $p = product::where('id','=',$id)->first();
        if($p){return view("vendor.deleteproduct")->with('product',$p);}
        else {return view("vendor.dashboard");}
    }
    function deleteproductConfirm($id){
        DB::delete('delete from products where p_id = ?',[$id]);
        $p = product::where('id','=',$id)->first();
        if($p){
            session()->flash('msg','Product Id '.$id.' Deletion Failed');
            return redirect()->route("vendor.dashboard");
        }
        else {
            session()->flash('msg','Product Id '.$id.' Deletion Successful');
            return redirect()->route("vendor.dashboard");
        }
    }
}
