<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\customer;
use App\Models\cart;
use App\Models\review;
use App\Models\customer_coupon;
use App\Models\notice;
use App\Models\coupon;
use App\Models\order;
use App\Models\product_order;
use App\Models\customer_product;

class APICustomersController extends Controller
{
    function __construct()
    {
        $this->middleware("authUser");
        $this->middleware("customer");
    }

    function profileinfo($id)
    {
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();
        return response()->json($customer, 200);
    }

    function updateprofile(Request $req)
    {
        $id = session()->get('user_id');

        $validator = Validator::make(
            $req->all(),
            [
                "username" => "required|unique:customers,username,$id",
                "name" => "required|regex:/^[a-z ,.'-]+$/i",
                "email" => "required|email|unique:customers,email,$id",
                "phone" => "required|numeric|digits:10",
                "gender" => "required",
                "dob" => "required|before:-10 years",
                "address" => "required"

            ],
            [
                'name.regex' => 'Name cannot contain special characters or numbers.',
                'dob.before' => 'User must be 10 years or older.',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $c_id = $req->id;
        $customer = customer::find($c_id);

        $customer->username = $req->username;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->gender = $req->gender;
        $customer->dob = $req->dob;
        $customer->address = $req->address;
        $customer->update();

        return response()->json(
            [
                "msg" => "Profile informations has been updated successfully!",
            ]
        );
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
        $customer = customer::where('id', session()->get('user_id'))->first();

        if ($customer->password == $req->current_pass) {
            $customer->password = $req->new_pass;
            $customer->update();

            return response()->json(["msg" => "Customer password has been successfully updated!"]);
        } else {
            return response()->json(
                [
                    "msg" => "Customer current password does not match!",
                ]
            );
        }
    }

    function updatedp(Request $req)
    {
        $user = customer::where('id', session()->get('user_id'))->first();

        if ($req->hasfile('file')) {
            $orgName = $req->file->getClientOriginalName();
            $ppName = $user->username . time() . $orgName;
            $req->file->storeAs('public/cprofile_images', $ppName);

            $user->propic = $ppName;
            $user->update();
            return response()->json(["msg" => "Profile photo has been updated successfully!"]);
        }
        return response()->json(["msg" => "No file has been selected!"]);
    }

    function addcart(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "quantity" => "required",
            //Others validation here

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $c_id = $req->c_id;
        $p_id = $req->p_id;

        $cart = cart::where('p_id', $p_id)->where('c_id', $c_id)->get();

        // return response()->json($cart);

        if (count($cart) != null) {
            $cart = cart::where('p_id', $p_id)->where('c_id', $c_id)->first();
            $cart->quantity = $cart->quantity + $req->quantity;
            $cart->update();

            return response()->json(["msg" => "Product has been added successfully!"]);
        } else {
            $cart = new cart();
            $cart->quantity = $req->quantity;
            $cart->c_id = $c_id;
            $cart->p_id = $req->p_id;
            $cart->save();

            return response()->json(["msg" => "Product has been added successfully!"]);
        }
    }

    function viewcart($id)
    {
        $carts = cart::where('c_id', $id)->get();
        return response()->json($carts);
    }

    function cartproductremove(Request $req)
    {
        $id = $req->cart_id;
        $carts = cart::where('id', $id)->delete();
        return response()->json(["msg" => "Product has been removed successfully!"]);
    }

    function cartquandecrement(Request $req)
    {
        $id = $req->cart_id;
        $cart = cart::where('id', $id)->first();

        if ($cart->quantity > 1) {

            $cart->quantity = $cart->quantity - 1;
            $cart->update();

            return response()->json(["msg" => "Product has been updated successfully!"]);
        } else {
            return response()->json(["msg" => "Product quantity can't be less than 1!"]);
        }
    }

    function cartquanincrement(Request $req)
    {
        $id = $req->cart_id;
        $cart = cart::where('id', $id)->first();
        $cart->quantity = $cart->quantity + 1;
        $cart->update();

        return response()->json(["msg" => "Product has been updated successfully!"]);
    }

    function reviews($id)
    {
        $reviews = review::where('c_id', $id)->where('message', '=', null)->get();
        $previews = review::where('c_id', $id)->where('message', '!=', null)->get();

        if (count($reviews) !== 0 || count($previews) !== 0) {
            return response()->json(["reviews" => $reviews, "previews" => $previews]);
        } else {
            // return response()->json(["msg" => "Your do not have any product for review!"]);
            return response()->json(["msg" => "NOreview!"]);
        }
    }

    function reviewview($id)
    {
        $review = review::where('id', $id)->first();

        return response()->json($review);
    }

    function reviewupdate(Request $req)
    {

        $review = review::find($req->r_id);

        $review->message = $req->r_message;
        $review->update();

        return response()->json(["msg" => "Review has been updated successfully!"]);
    }

    function reviewdelete(Request $req)
    {
        $review = review::find($req->r_id);

        $review->message = null;
        $review->update();

        return response()->json(["msg" => "Review has been deleted successfully!"]);
    }

    function coupons($id)
    {
        $coupons = customer_coupon::where('c_id', $id)->get();

        if (count($coupons) !== 0) {
            return response()->json($coupons);
        } else {
            // return response()->json(["msg" => "Your do not have any coupon!"]);
            return response()->json(["msg" => "NOcoupon!"]);
        }
    }

    function notices($id)
    {
        $notices = notice::where('c_id', $id)->get();

        if (count($notices) !== 0) {
            return response()->json($notices);
        } else {
            // return response()->json(["msg" => "Your do not have any notice!"]);
            return response()->json(["msg" => "NOnotice!"]);
        }
    }

    function confirmorder(Request $req)
    {
        $c_id = session()->get('user_id');

        $validator = Validator::make($req->all(), [
            "payment_option" => "required",
            "delivery_address" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //


        if (isset($req->coupon)) {

            $coupon = customer_coupon::where('c_id', $c_id)->first();
            if ($coupon != null) {
                $checkcoupon = coupon::where('id', $coupon->co_id)->where('code', $req->coupon)->first();

                if ($checkcoupon  != null) {

                    $carts = cart::where('c_id', $c_id)->get();

                    foreach ($carts as $item) {

                        $order = new order();
                        $order->p_id = $item->p_id;
                        $order->quantity = $item->quantity;
                        $order->c_id = $item->c_id;
                        $order->status = "Pending";
                        $order->payment_method = $req->payment_option;
                        $order->payment_status = "Unpaid";
                        $order->delivery_address = $req->delivery_address;
                        $order->co_id = $checkcoupon->id;
                        $order->save();

                        //
                        $o = order::where('p_id', '=', $item->p_id)->where('c_id', '=', $item->c_id)->where('quantity', '=', $item->quantity)->first();
                        $po = new product_order();
                        $po->p_id = $item->p_id;
                        $po->o_id = $o->id;
                        $po->save();

                        $cp = new customer_product();
                        $cp->p_id = $item->p_id;
                        $cp->c_id = $item->c_id;
                        $cp->save();
                        //

                        cart::where('c_id', $c_id)->delete();
                    }

                    // return redirect()->route('customer.placeOrder');
                    return response()->json(["confirmed" => "Your order has been placed!"]);
                } else {
                    // session()->flash('Msg', "Invalid Coupon Code!");
                    // return redirect()->route('customer.corder');
                    return response()->json(["invalid" => "Invalid Coupon Code!"]);
                }
            } else {
                // session()->flash('Msg', "p Invalid Coupon Code!");
                // return redirect()->route('customer.corder');
                return response()->json(["invalid" => "Invalid Coupon Code!"]);
            }
        } else {
            $carts = cart::where('c_id', $c_id)->get();

            foreach ($carts as $item) {

                $order = new order();
                $order->p_id = $item->p_id;
                $order->quantity = $item->quantity;
                $order->c_id = $item->c_id;
                $order->status = "Pending";
                $order->payment_method = $req->payment_option;
                $order->payment_status = "Unpaid";
                $order->delivery_address = $req->delivery_address;
                $order->save();

                //
                $o = order::where('p_id', '=', $item->p_id)->where('c_id', '=', $item->c_id)->where('quantity', '=', $item->quantity)->first();
                $po = new product_order();
                $po->p_id = $item->p_id;
                $po->o_id = $o->id;

                $cp = new customer_product();
                $cp->p_id = $item->p_id;
                $cp->c_id = $item->c_id;
                $cp->save();
                //

                cart::where('c_id', $c_id)->delete();
            }
            // return redirect()->route('customer.placeOrder');
            return response()->json(["confirmed" => "Your order has been placed!"]);
        }
    }
}
