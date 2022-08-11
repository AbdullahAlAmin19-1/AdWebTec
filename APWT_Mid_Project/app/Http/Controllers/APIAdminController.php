<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\vendor;
use App\Models\req_deliveryman;
use App\Models\notice;
use App\Models\order;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\requested_coupon;
use App\Models\customer_product;
use App\Models\customer_coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class APIAdminController extends Controller
{
    function profile()
    {
        $admin = admin::where('id', '=', 1)->first();
        return response()->json($admin, 200);
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

        $a_id = $req->id;
        $admin = admin::find($a_id);

        $admin->username = $req->username;
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->phone = $req->phone;
        $admin->gender = $req->gender;
        $admin->dob = $req->dob;
        $admin->address = $req->address;
        $admin->update();

        return response()->json(
            [
                "msg" => "Updated Successfully",
            ]
        );
    }
    function updatepropic(Request $req)
    {

        //Get user id and username here
        //
        $no_id = 1;
        $no_username = "admin_";

        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $ppName = $no_username.time().$orgName;
            $req->file->storeAs('public/admin_profile_images',$ppName);

            $admin = admin::find($no_id);
            $admin->propic = $ppName;
            $admin->update();
            return response()->json(["msg"=>$ppName]);
        }
        return response()->json(["msg"=>"No file"]);
    }

    function viewallnotice(){
        $notice = notice::all();
        return response()->json($notice, 200);
    }
    function sendnoticeupdate(Request $vali){
        if($vali->user_type=="Vendor")
        {
            $validator = Validator::make($vali->all(),[
                "subject"=>"required",
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $u=vendor::where('email','=',$vali->email)->first();
            
            $mail= new notice();
            $mail->email =$vali->email;
            // $mail->a_id =$vali->a_id;
            $mail->v_id =$u->id;
            $mail->user_type =$vali->user_type;
            $mail->subject =$vali->subject;
            $mail->message =$vali->message;
            $mail->save();
        }
        elseif($vali->user_type=="Customer"){
            $validator = Validator::make($vali->all(),[
                "subject"=>"required",
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $u=customer::where('email','=',$vali->email)->first();
            
            $mail= new notice();
            $mail->email =$vali->email;
            // $mail->a_id =$vali->a_id;
            $mail->c_id =$u->id;
            $mail->user_type =$vali->user_type;
            $mail->subject =$vali->subject;
            $mail->message =$vali->message;
            $mail->save();
        }
        // return redirect()->route('mail.sendNoticeAPI',['id'=>$mail->id]);
        return response()->json(
            [
                "msg"=>"Notice Sent Successfully",
                "data"=>$mail
            ]
        );
    }

    function viewrequestedcoupon(){
        $c = requested_coupon::all();
        return response()->json($c, 200);
    }
    function cancelcoupon($id){

        $req =DB::delete('delete from requested_coupons where id = ?',[$id]);
        return response()->json(
            [
                "msg"=>"Cancelled Successfully",
                "data"=>$req
            ]
        );
    }
    function approvecoupon($id){

        $req = requested_coupon::where('id', $id)->first();

        $co = new coupon();
        $co->code = $req->code;
        $co->amount =$req->amount;
        $co->v_id = $req->v_id;
        $co->save();
        $req =DB::delete('delete from requested_coupons where id = ?',[$id]);
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$co
            ]
        );
    }

    function addcoupon(Request $value){
    
        $c=new coupon();
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
    function viewcoupon(){
        $c = coupon::all();
        return response()->json($c, 200);
    }
    function removecoupon($id){

        $req =DB::delete('delete from coupons where id = ?',[$id]);
        return response()->json(
            [
                "msg"=>"Removed Successfully",
                "data"=>$req
            ]
        );
    }
}
