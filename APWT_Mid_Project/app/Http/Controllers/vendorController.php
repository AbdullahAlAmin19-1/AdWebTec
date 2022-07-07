<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\product;
use App\Models\coupon;
use App\Models\order;
use App\Models\review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
    }
    // function welcome(){return view("public.welcome");}
    public function dashboard(){
        session()->put('product_navbar','yes');
        $p=product::where('v_id','=',session()->get('id'))->simplePaginate(4);
        return view('vendor.dashboard', compact('p'));
    }
    function profile(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
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
    function productNavbar(){
        session()->put('product_navbar','yes');
        return view('vendor.addproduct');
    }
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
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->thumbnail = $vali->thumbnail;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        // $p->color = $vali->color;
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
        DB::delete('delete from products where id = ?',[$id]);
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
    function couponNavbar(){
        session()->forget('product_navbar');
        session()->put('coupon_navbar','yes');
        return view('vendor.coupon');
    }
    function createcoupon(Request $value){
        $c=new coupon();
        if($value->codetype=='auto'){
            $c->code=Str::random($value->code);
        }
        elseif($value->codetype=='manual'){
            $c->code=$value->code;
        }
        $c->amount=$value->amount;
        $c->save();
        session()->flash('msg','Coupon Created');
        return redirect()->route("vendor.dashboard");
    }
    function allcoupons(){
        $c = coupon::all();
        return view('vendor.allcoupons')->with('coupons',$c);
    }
    function editcoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return view('vendor.editcoupon')->with('c',$c);
    }
    function deletecoupon($id){
        $c = coupon::all();
        return view('vendor.editcoupon')->with('coupons',$c);
    }
    function editcouponconfirm(Request $value){
        $c = coupon::where('id','=',$value->id)->first();
        $c->code=$value->code;
        $c->amount=$value->amount;
        $c->save();
        session()->flash('msg','Coupon Id '.$value->id.' Updated');
        return redirect()->route("vendor.allcoupons");;
    }
    function orders(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $o = order::all();
        return view('vendor.orders')->with('orders',$o);
    }
    function changeorderstatus($id){
        $o = order::where('id','=',$id)->first();
        if($o->status=='Pending'){$o->status='Confirmed';}
        elseif($o->status=='Confirmed'){$o->status='Delivered';}
        $o->update();
        session()->flash('msg','Order Updated');
        return redirect()->route("vendor.orders");;
    }
    function changepaymentstatus($id){
        $o = order::where('id','=',$id)->first();
        $o->payment_status='Confirmed';
        $o->update();
        session()->flash('msg','Order Updated');
        return redirect()->route("vendor.orders");;
    }
    function reviews(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $r = review::all();
        return view('vendor.allreview')->with('reviews',$r);
    }
}
