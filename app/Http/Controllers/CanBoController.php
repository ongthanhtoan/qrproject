<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CanBoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CanBo = DB::table('canbo')->get();
        return view('backend.canbo.index')->with('danhsachcanbo',$CanBo);
    }
    public function capQuyen($id){
        if(DB::table('canbo')->where('cb_TenDangNhap',$id)->update([
            'cb_KiemKe' => 1
        ])){
            return response()->json([
                $data = 1
            ],200);
        }else{
            return response()->json([
                $data = 2
            ],200);
        }
    }
    public function huyQuyen($id){
        if(DB::table('canbo')->where('cb_TenDangNhap',$id)->update([
            'cb_KiemKe' => 0
        ])){
            return response()->json([
                $data = 1
            ],200);
        }else{
            return response()->json([
                $data = 2
            ],200);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $User = DB::table('users')->get();
        // foreach ($CanBo as $key => $value) {
        //     $User = DB::table('users')->where('username','<>',$value->cb_TenDangNhap)->get();
        // }
        return $User;
        // print_r($CanBo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $User = DB::table('users')->where('username',$request->slAdmin)->get();
        if(DB::table('canbo')->insert(
            [
                'cb_TenDangNhap' => $User[0]->username,
                'cb_HoTen' => $User[0]->HoTen,
                'cb_KiemKe' => 0
            ])){
            return response()->json([
                $data = 1
            ],200);
        }else{
            return response()->json([
                $data = 2
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Parent1 = DB::table('bangiao')->where('bg_NguoiGiao',$id)->orwhere('bg_NguoiNhan',$id)->count();
        $Parent2 = DB::table('taisan_'.date('Y'))->where('cb_TenDangNhap',$id)->count();
        if($Parent1 == 0 && $Parent2 == 0){
            if(DB::table('canbo')->where('cb_TenDangNhap',$id)->delete()){
                return response()->json([
                    $data = 1
                ],200);
            }
        }else{
            return response()->json([
                $data = 2
            ],200);
        }
    }
}
