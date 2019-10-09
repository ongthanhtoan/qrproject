<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
class CheckKiemKe
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
            $Info = Session::get('user');
            $CanBo = DB::table('canbo')->where('cb_TenDangNhap',$Info['username'])->get();
            if($CanBo[0]->cb_KiemKe == 1){
                return $next($request);
            }else
            Session::flash('KiemKe','Bạn Không Có Quyền Để Kiểm Kê Tài Sản!!!');
            return redirect()->route('dsBanGiao.dsBanGiao');
        }else{
            return redirect()->route('dang-nhap.getDangNhap');
        }
    }
}
// return $next($request);