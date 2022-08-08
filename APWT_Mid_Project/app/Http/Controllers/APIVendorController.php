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

class APIVendorController extends Controller
{
    function profile($id)
    {
        $user = vendor::where('id', '=', $id)->first();
        return response()->json($user, 200);
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
                "msg" => "Updated Successfully",
            ]
        );
    }

    function updatedp(Request $req)
    {
        //Get user id and username here
        $no_id = 1;
        $no_username = "Al Amin";

        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $ppName = $no_username.time().$orgName;
            $req->file->storeAs('public/vendor_profile_images',$ppName);

            $customer = vendor::find($no_id);
            $customer->propic = $ppName;
            $customer->update();
            return response()->json(["msg"=>$ppName]);
        }
        return response()->json(["msg"=>"No file"]);
    }

    function addProduct(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
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
                "msg"=>"Added Successfully",
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
        $validator = Validator::make($req->all(), [
            "name" => "required",
            //Others validation here

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
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
                "msg" => "Updated Successfully",
            ]
        );
    }

    function updateThumbnail(Request $req)
    {
        if($req->hasfile('file')){
            // $product = product::where('name', '=', $req->name)->first();
            
            $p= product::where('id', '=', $req->id)->first();
            $extension = $req->file->getClientOriginalName();
            $thumbnail = $product->name.time().$orgName;
            $req->file->storeAs('public/product_images',$thumbnail);
            $product->thumbnail = $thumbnail;
            $product->update();
            return response()->json(["msg"=>$thumbnail]);
        }
        return response()->json(["msg"=>"No file"]);
        // 
        // $extension = $req->file('thumbnail')->getClientOriginalExtension();
        // $picname = $product->name.time().".".$extension;
        
        // $req->file('thumbnail')->storeAs('public/product_images', $picname);
        // $product = product::find($req->id);
        // $product->thumbnail = $picname;
        // $product->update();
        // if($product){
        //     return response()->json(["msg"=>$ppName]);
        // }
        // return response()->json(["msg"=>"No file"]);
    }

    function deleteProduct($id){
        DB::delete('delete from products where id = ?',[$id]);
        return response()->json(
            [
                "msg" => "Product Deleted",
            ]
        );
    }

    function allCoupons(){
        $c = coupon::all();
        return response()->json($c, 200);
    }

    function addCoupon(Request $value){
    
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
        return response()->json($c, 200);
    }

    function editCoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return response()->json($c, 200);
    }

    
    function updateCoupon(Request $value){
        $c = coupon::where('id','=',$value->id)->first();
        $c->code=$value->code;
        $c->amount=$value->amount;
        $c->save();
        return response()->json($c, 200);
    }

    function deleteCoupon($id){
        DB::delete('delete from coupons where id = ?',[$id]);
        return response()->json(
            [
                "msg" => "Coupon Deleted",
            ]
        );
    }

}
