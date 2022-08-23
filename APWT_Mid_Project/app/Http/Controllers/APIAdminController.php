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
use Datetime;

class APIAdminController extends Controller
{
    function __construct(){
        $this->middleware("authUser");
        $this->middleware("admin");
    }
    function profile($id)
    {
        $admin = admin::where('id', '=', $id)->first();
        return response()->json($admin, 200);
    }
    function updateprofile(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
            "phone"=>"required|numeric|digits:10",
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
                "admin"=>$admin        
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
    function changepassword(Request $req)
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
        $admin = admin::where('id', session()->get('user_id'))->first();

        if ($admin->password == $req->current_pass) {
            $admin->password = $req->new_pass;
            $admin->update();

            return response()->json(["msg" => "Password has been successfully updated!"]);
        } else {
            return response()->json(
                [
                    "msg" => "Current password does not match!",
                ]
            );
        }
    }
    function viewallnotice(){
        // $notice = notice::with(['customer','vendor'])->all();
        $notice = notice::all();
        return response()->json($notice, 200);
    }
    function viewnotice($id){
        $notice = notice::where('id', $id)->with(['customer','vendor'])->first();
        return response()->json($notice, 200);
    }
    
    function editnoticeupdate(Request $vali){
        $validator = Validator::make($vali->all(),[
            "subject"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $mail= notice::find($vali->id);
        $mail->subject =$vali->subject;
        $mail->message =$vali->message;
        $mail->update();

        return response()->json(
            [
                "msg"=>"Notice updated Successfully"
            ]
        );
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
            $mail->a_id =$vali->a_id;
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
            $mail->a_id =$vali->a_id;
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
    function editcoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return response()->json($c, 200);
    }
    function editcouponupdate(Request $vali){
        $validator = Validator::make($vali->all(),[
            "code"=>"required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $c= coupon::find($vali->id);
        $c->code=$vali->code;
        $c->amount=$vali->amount;
        $c->update();
        return response()->json(
            [
                "msg"=>"Coupon updated Successfully"
            ]
        );
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
    function searchproducts($keyword){
        $products =product::where('name', 'like', '%'.$keyword.'%')->get();
        return response()->json($products);
    }

    function viewreqdeliveryman(){
        $d = req_deliveryman::all();
        return response()->json($d, 200);
    }
    function approvedeliveryman($id){

        $req = req_deliveryman::where('id', $id)->first();
        $user = new deliveryman();
        $user->name = $req->name;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = $req->password;
        $user->gender = $req->gender;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->save();
        $req =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$user
            ]
        );
    }
    function canceldeliveryman($id){
        $req =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        return response()->json(
            [
                "msg"=>"Cancelled Successfully",
                "data"=>$req
            ]
        );
    }
}
