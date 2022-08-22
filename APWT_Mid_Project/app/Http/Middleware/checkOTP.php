<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkOTP
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
        // if(session()->has('checkotp')){
        //     return $next($request);
        // }
        // return redirect()->route('public.forgotpassword');
        if($request->header("otp")!=null){
            session()->put('otp',$request->header("otp"));
            return $next($request);
        }
        return response()->json(["msg"=>"User Not Valid"],400);
    }
}
