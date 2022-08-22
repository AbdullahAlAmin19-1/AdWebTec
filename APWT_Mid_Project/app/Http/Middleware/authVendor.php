<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(session()->get('user_type')=='Admin'){
        //     return $next($request);
        // }
        // return redirect()->route('public.products');
        if($request->header("user_type")=='Vendor'){
            session()->put('user_id',$request->header("user_id"));
            session()->put('product_id',$request->header("product_id"));
            session()->put('user_type',$request->header("user_type"));
            // session()->put('otp',$request->header("otp"));
            return $next($request);
        }
        return response()->json(["msg"=>"User Type not valid"],401);
    }
}
