<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\vendor;
use App\Models\product;
use App\Models\requested_coupon;
use App\Models\coupon;
use App\Models\notice;
use App\Models\review;
use App\Models\customer;
use App\Models\order;
use App\Models\customer_coupon;
use App\Models\cart;
use App\Models\customer_product;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendOTP;
use App\Mail\elogin;

class APIVendorController extends Controller
{
    function __construct(){
        $this->middleware("authUser");
        $this->middleware("vendor");
    }

    function profile($id)
    {
        $user = vendor::where('id', '=', $id)->first();
        return response()->json($user, 200);
    }

    function updateprofile(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
            "username"=>"required",
            "email"=>"required",
            "phone"=>"required|numeric|digits:10",
            "gender"=>"required",
            "dob"=>"required|before:-18 years",
            "address"=>"required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 18 years or older.',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $user = vendor::find($req->id);

        $user->username = $req->username;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->update();

        return response()->json(
            [
                "user"=>$user, 
                "msg" => "Updated Successfully"
            ]
        );
    }

    function updatedp(Request $req)
    {
        //Get user id and username here
        $user = vendor::where('id', session()->get('user_id'))->first();

        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $ppName = $user->username.time().$orgName;
            $req->file->storeAs('public/vendor_profile_images',$ppName);

            $user->propic = $ppName;
            $user->update();
            return response()->json(["msg"=>$ppName]);
        }
        return response()->json(["msg"=>"No file"]);
    }

    function changepass(Request $req)
    {
        $validator = Validator::make(
            $req->all(),
            [
                "current_pass" => "required",
                "new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "confirm_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",

            ],

            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'confirm_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $vendor = vendor::where('id', session()->get('user_id'))->first();

        if ($vendor->password == $req->current_pass) {
            $vendor->password = $req->new_pass;
            $vendor->update();

            return response()->json(["msg" => "Vendor password has been successfully updated!"]);
        } else {
            return response()->json(
                [
                    "errmsg" => "Vendor current password does not match!",
                ]
            );
        }
    }

    function forgotPass(Request $vali){
        $validator = Validator::make($vali->all(),
            [
                "email" => "required"
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
       
        if($user){
            session()->put('resetpass','yes');
            $otp = random_int(100000, 999999);
            Mail::to([$user->email])->send(new sendOTP("Access OTP",$vali->user_type,$user->username,$user->email,$otp));
            return response()->json(
                [
                    "msg"=>"Check Email For OTP",
                    "otp"=>$otp
                ]
            );
        }
        else {
            return response()->json(
                [
                    "errmsg"=>"Enter Correct Email"
                ]
            );
        }
    }

    function enterOTP(Request $vali){
        if(Session()->get('otp')==$vali->otp){
            return response()->json(
                [
                    "msg"=>"Create New Password"
                ]
            );
        }
        else {
            return response()->json(
                [
                    "errmsg"=>"OTP Not Valid"
                ]
            );
        }
    }

    function createNewPass(Request $vali){
        $validator = Validator::make(
            $vali->all(),
            [
                "new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",

            ],

            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
       
        
        $user->password = $vali->new_pass;
        $user->update();
        return response()->json(
            [
                "msg"=>"Password Change Completed"
            ]
        );
    }

    function products()
    {
        $products = Product::all();
        return response()->json($products);
    }

    function addProduct(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
            "category"=>"required",
            "price"=>"required",
            "stock"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $thumbnail = null;

        if($req->thumbnail!=null){
            $extension = $req->file('thumbnail')->getClientOriginalExtension();
            $thumbnail = $req->name.time().".".$extension;
            $req->file('thumbnail')->storeAs('public/product_images', $thumbnail);
        }

        $p=new product();
        $p->name = $req->name;
        $p->category = $req->category;
        $p->thumbnail = $thumbnail;
        $p->price = $req->price;
        $p->stock = $req->stock;
        // $p->color = $req->color;
        $p->size = $req->size;
        $p->description = $req->description;
        // $p->v_id = Session()->get('id');
        $p->save();
        return response()->json(
            [
                "msg"=>"Product Added Successfully",
                "data"=>$p        
            ]
        );
    }

    function editProduct($id)
    {
        $p = product::where('id', '=', $id)->first();
        return response()->json($p, 200);
    }

    function updateProduct(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "name"=>"required",
            "category"=>"required",
            "price"=>"required",
            "stock"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $p= product::where('id', '=', $req->id)->first();
        $p->name = $req->name;
        $p->category = $req->category;
        $p->price = $req->price;
        $p->stock = $req->stock;
        // $p->color = $req->color;
        $p->size = $req->size;
        $p->description = $req->description;
        // $p->v_id = Session()->get('id');
        $p->save();
        return response()->json(
            [
                "msg" => "Product Updated Successfully",
            ]
        );
    }

    function updateThumbnail(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "file"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $product = product::where('id', session()->get('product_id'))->first();

        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $thumbnail = $product->name.time().$orgName;
            $req->file->storeAs('public/product_images',$thumbnail);

            $product->thumbnail = $thumbnail;
            $product->update();
            return response()->json(["msg"=>$thumbnail]);
        }
        return response()->json(["msg"=>"No file"]);
    }

    function deleteProduct($id){
        $cart = cart::where('p_id','=',$id)->first();
        if($cart){
            return response()->json(
                [
                    "errmsg" => "Product Id $id is in cart, remove it from cart before Deleting the Product",
                ]
            );
        }
        $o = order::where('p_id','=',$id)->first();
        if($o){
            if($o->status!='Delivered'){
                return response()->json(
                    [
                        "errmsg" => "Product Id $id can not be deleted",
                    ]
                );
            }
        }
        $cp = customer_product::where('p_id','=',$id)->first();
        if($cp){
            return response()->json(
                [
                    "errmsg" => "Product Id $id can not be deleted",
                ]
            );
        }
        DB::delete('delete from products where id = ?',[$id]);
        return response()->json(
            [
                "msg" => "Product Id $id Deletion Successful",
            ]
        );
    }
    function ProductChartData()
    {
        $FruitsVegetables = product::where('category', '=', 'Fruits & Vegetables')->get();
        $MeatFish = product::where('category', '=', 'Meat & Fish')->get();
        $Cooking = product::where('category', '=', 'Cooking')->get();
        $Baking = product::where('category', '=', 'Baking')->get();
        $Dairy = product::where('category', '=', 'Dairy')->get();
        $CandyChocolate = product::where('category', '=', 'Candy & Chocolate')->get();
        $FrozenCanned = product::where('category', '=', 'Frozen & Canned')->get();
        $BreadBakery = product::where('category', '=', 'Bread & Bakery')->get();
        $Breakfast = product::where('category', '=', 'Breakfast')->get();
        $Snacks = product::where('category', '=', 'Snacks')->get();
        $Beverages = product::where('category', '=', 'Beverages')->get();
        $Others = product::where('category', '=', 'Others')->get();
        
        return response()->json(
            [
                "FruitsVegetables" => count($FruitsVegetables),
                "MeatFish" => count($MeatFish),
                "Cooking" => count($Cooking),
                "Baking" => count($Baking),
                "Dairy" => count($Dairy),
                "CandyChocolate" => count($CandyChocolate),
                "FrozenCanned" => count($FrozenCanned),
                "BreadBakery" => count($BreadBakery),
                "Breakfast" => count($Breakfast),
                "Snacks" => count($Snacks),
                "Beverages" => count($Beverages),
                "Others" => count($Others)
            ]
        );
    }

    function allCoupons(){
        $c = coupon::all();
        return response()->json($c, 200);
    }

    function addCoupon(Request $value){
    
        $validator = Validator::make($value->all(),[
            "codetype"=>"required",
            "code"=>"required|unique:requested_coupons|unique:coupons",
            "amount"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $c=new requested_coupon();
        if($value->codetype=='auto'){
            if(is_numeric($value->code)){
                $c->code=Str::random($value->code);
            }
        }
        elseif($value->codetype=='manual'){
            $c->code=$value->code;
        }
        $c->amount=$value->amount;
        $c->save();
        return response()->json(
        [
            "msg" => "Coupon Added Successfully",
            "Coupon" => $c
        ]
    );
    }

    function editCoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return response()->json($c, 200);
    }
    
    function updateCoupon(Request $value){
        
        $validator = Validator::make($value->all(),[
            "code"=>"required",
            "amount"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        
        $c = coupon::where('id','=',$value->id)->first();
        $c->code=$value->code;
        $c->amount=$value->amount;
        $c->save();
        return response()->json(
            [
                "msg" => "Coupon Updated Successfully",
                "Coupon" => $c
            ]
        );
    }

    function deleteCoupon($id){
        $cco = customer_coupon::where('co_id','=',$id)->first();
        if($cco){
            return response()->json(
                [
                    "errmsg" => "Coupon Id $id belongs to customer, remove or wait for the customer to use it before Deleting the Coupon",
                ]
            );
        }
        DB::delete('delete from coupons where id = ?',[$id]);
        return response()->json(
            [
                "msg" => "Coupon Id $id Deletion Successful",
            ]
        );
    }

    function assigncoupon(Request $req){
        
    $validator = Validator::make($req->all(),[
        "c_id" => "required",
    ]);
    if($validator->fails()){
        return response()->json($validator->errors(),422);
    }

    $c = customer::where('id','=',$req->c_id)->first();
    if(!$c){
        return response()->json(
            [
                "errmsg" => "Invalid Customer Id, Enter a vaild Id",
            ]
        );
    }
    $o = order::where('c_id','=',$req->c_id)->where('co_id','=',$req->co_id)->first();
    if($o){
        return response()->json(
            [
                "errmsg" => "Coupon Id $req->co_id has already been used by Custimer Id $req->c_id",
            ]
        );
    }
    $cco = customer_coupon::where('c_id','=',$req->c_id)->where('co_id','=',$req->co_id)->first();
    if($cco){
        return response()->json(
            [
                "errmsg" => "Coupon Id $req->co_id has already been assign to Custimer Id $req->c_id",
            ]
        );
    }
    $assign = new customer_coupon();
    $assign->c_id=$req->c_id;
    $assign->co_id=$req->co_id;
    $assign->save();
    return response()->json(
        [
            "msg" => "Coupon Id $req->co_id has been assigned to Custimer Id $req->c_id",
        ]
    );
    }

    function notices($id)
    {
        $notices = notice::where('v_id', $id)->get();

        if (count($notices)) {
            return response()->json($notices);
        } else {
            // return response()->json(["msg" => "Your do not have any notice!"]);
            return response()->json(["errmsg" => "No Notice Available"]);
        }
    }

    function reviews()
    {
        $reviews = review::all();

        if (count($reviews)) {
            return response()->json(["reviews" => $reviews]);
        } else {
            return response()->json(["errmsg" => "No Review Available"]);
        }
    }

    function orders(){
        $orders = order::all();
        
        $order = order::where('id', 14)->first();

        // foreach ($customers as $customer){
    //     foreach($customer->products as $p){
    //         // $o=$p->orders;
    //         foreach ($p->orders as $o){
    //         echo $o->id;
    //     }break;
    // }
    // }
        // echo $o= $c->orders->first();
        // echo $o->coupon;
        // $p= $o->products;
        // echo $p;

        return response()->json(["orders" => $orders, "order" => $order]);
    }
    
    function searchproducts($keyword){
        $products =product::where('name', 'like', '%'.$keyword.'%')->get();
        return response()->json($products);
    }
}
