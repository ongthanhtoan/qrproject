<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('admin')){
            return $next($request);
        }else if(Session::has('user')){
            return redirect()->route('dsBanGiao.dsBanGiao');
        }else{
            return redirect()->route('dang-nhap.getDangNhap');
        }
        
    }
}
