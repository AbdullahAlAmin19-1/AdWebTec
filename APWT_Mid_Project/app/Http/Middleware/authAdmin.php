<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authAdmin
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
        if($request->header("user_type")=='Admin'){
            session()->put('user_id',$request->header("user_id"));
            session()->put('user_type',$request->header("user_type"));
            return $next($request);
        }
        return response()->json(["msg"=>"User Type not valid"],401);
    }
}
