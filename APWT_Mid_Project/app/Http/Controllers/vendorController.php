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
use App\Models\customer;
use App\Models\notice;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirmOrder;
use App\Mail\confirmDelivery;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
        $this->middleware("vendor");
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
        
        $id = session()->get('id');
        $this->validate($vali, [
            "username" => "required|unique:vendors,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:vendors,email,$id",
            "phone"=>"required|numeric|digits:10",
            "gender" => "required",
            "dob" => "required||before:-18 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 18 years or older.',
        ]
        );
        $user=vendor::where('id','=',$id)->first();
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
        return back();
    }
    function changepassword(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.changepassword")->with('vendor',$user);}
        else {return view("vendor.dashboard");}
    }
    function changepasswordupdated(Request $vali){
        $this->validate($vali, [
            "cur_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "conf_new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
        ],
        [
            'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
        ]
        );
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user->password == $vali->cur_pass){
            $user->password = $vali->new_pass;
            $user->update();
            session()->flash('msg','Password Update Completed');
            return back();
        }
        else {
            session()->flash('msg',"Current Password Dosen't Match");
            return back();
        }
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
        // $p->color = $vali->color;
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->v_id = Session()->get('id');
        $p->save();
        session()->flash('msg','Product Added');
        return back();
    }
    function productpicupload(Request $req){
        $this->validate($req, [
            "pic" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'pic.required' => 'Please select a picture!',
            'pic.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
        );
        $product = product::find($req->id);
        $extension = $req->file('pic')->getClientOriginalExtension();
        $picname = $product->name.time().".".$extension;
        $req->file('pic')->storeAs('public/product_images', $picname);
        $product->thumbnail = $picname;
        $product->update();

        session()->flash('msg','Thumbnail Updated');
        return back();
    }    
    function editproduct($id){
        $p = product::find($id);
        // $p = product::where('id','=',$id)->first();
        if($p){return view("vendor.editProduct")->with('product',$p);}
        else {return redirect()->route("vendor.dashboard");}
    }
    function editproductConfirm(Request $vali){
        $this->validate($vali, [
            "name" => "required",
            "category" => "required",
            "price" => "required",
            "stock" => "required",
        ],
        []
        );

        $p = product::find($vali->id);
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        $p->size = $vali->size;
        $p->description = $vali->description;
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
        $this->validate($value, [
            "codetype" => "required",
            "code" => "required",
            "amount" => "required"
        ],
        []
        );
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
        DB::delete('delete from coupons where id = ?',[$id]);
        $c = coupon::where('id','=',$id)->first();
        if($c){
            session()->flash('msg','Coupon Id '.$id.' Deletion Failed');
            return redirect()->route("vendor.allcoupons");
        }
        else {
            session()->flash('msg','Coupon Id '.$id.' Deletion Successful');
            return redirect()->route("vendor.allcoupons");
        }
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
        return view('vendor.allorders')->with('orders',$o);
    }
    function changeorderstatus($id){
        $o = order::where('id','=',$id)->first();
        if($o->status=='Pending'){
            $o->status='Confirmed';
            Mail::to($o->customer->email)->send(new confirmOrder("Confirmation of your Order",$o->customer->name,$o->products->name,$o->quantity,$o->delivery_address));
                }
        elseif($o->status=='Confirmed'){
            $o->status='Delivered';
            Mail::to($o->customer->email)->send(new confirmDelivery("Confirmation of your Delivery",$o->customer->name,$o->products->name,$o->quantity,$o->delivery_address));
            $r = new review();
            $r->c_id=$o->c_id;
            $r->p_id=$o->p_id;
            $r->save();
        }
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
        return view('vendor.allreviews')->with('reviews',$r);
    }
    function notices(){
        $n = notice::where('v_id','=',session()->get('id'))->get();
        return view('vendor.notice')->with('notices',$n);
    }
    function test(){
        $co=coupon::where('id','=','1')->first();
        echo $co->customers;
        // echo $co->vendor;
        $c=customer::where('id','=','1')->first();
        // echo $c->coupons;
        // echo $c->products;
        // echo $c->orders;
        // echo $c->reviews;
        $o=order::where('id','=','2')->first();
        // echo $o->coupon;
        // echo $o->customer->name;
        // echo $o->products->name;
        $p=product::where('id','=','2')->first();
        // echo $p->customers;
        // echo $p->reviews;
        // echo $p->vendor;
        // echo $p->order;
        $r=review::where('id','=','1')->first();
        // echo $r->product;
        // echo $r->customer;
        $v=vendor::where('id','=','1')->first();
        // echo $v->coupons;
        // echo $v->products;
        // date_default_timezone_set('Asia/Dhaka');
        // echo $current_time = date("H:i:s");
        // echo date_default_timezone_get(); 
    }
}