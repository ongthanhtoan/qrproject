<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\HienTrang;
use App\DonVi;
use App\Phong;
class BanGiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
    	$Y = date('Y');
    	$CanBo = DB::table('canbo')->get();
    	$bangiao = DB::table('bangiao')
    	->join('taisan_'.$Y,'bangiao.ts_MaTS','=','taisan_'.$Y.'.ts_MaTS')
    	->join('donvi','bangiao.dv_MaDV','=','donvi.dv_MaDV')
    	->join('phong','bangiao.p_MaPhong','=','phong.p_MaPhong')->get();
    	return view('backend.bangiao.index')->with('dsBanGiao',$bangiao)->with('dsCanBo',$CanBo);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$Y = date('Y');
        // lấy những tài sản chưa bàn giao
        //where('ts_HieuLuc',0)
    	$TaiSan = DB::table('taisan_'.$Y)->get();
    	$HienTrang = HienTrang::all();
    	$DonVi = DonVi::all();
    	$Phong = Phong::all();
    	$CanBo = DB::table('canbo')->get();
    	return view('backend.bangiao.create')->with('dsTaiSan',$TaiSan)->with('dsHienTrang',$HienTrang)->with('dsDonVi',$DonVi)->with('dsPhong',$Phong)->with('dsCanBo',$CanBo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$Y = date('Y');
    	if(DB::table('bangiao')->insert(
    		[
    			'ts_MaTS' => $request->slTaiSan,
    			'bg_NgayGiao' => $request->bg_NgayGiao,
    			'bg_NguoiGiao' => $request->slNguoiGiao,
    			'bg_NgayNhan' => $request->bg_NgayNhan,
    			'bg_NguoiNhan' => $request->slNguoiNhan,
    			'dv_MaDV' => $request->slDonVi,
    			'p_MaPhong' => $request->slPhong,
    		])){
    		DB::table('taisan_'.$Y)->where('ts_MaTS', $request->slTaiSan)->update(['ts_HieuLuc' => 1]);
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
    	$Y = date('Y');
    	$BanGiao = DB::table('bangiao')->where('bg_MaBG',$id)->first();
    	$TaiSan = DB::table('taisan_'.$Y)->get();
    	$HienTrang = HienTrang::all();
    	$DonVi = DonVi::all();
    	$Phong = Phong::all();
    	$CanBo = DB::table('canbo')->get();
    	return view('backend.bangiao.edit')->with('dsTaiSan',$TaiSan)->with('dsHienTrang',$HienTrang)->with('dsDonVi',$DonVi)->with('dsPhong',$Phong)->with('dsCanBo',$CanBo)->with('BanGiao',$BanGiao);
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
    	try{
    		DB::table('bangiao')->where('bg_MaBG', $id)->update(
    			[
    				'ts_MaTS' => $request->slTaiSan,
    				'bg_NgayGiao' => $request->bg_NgayGiao,
    				'bg_NguoiGiao' => $request->slNguoiGiao,
    				'bg_NgayNhan' => $request->bg_NgayNhan,
    				'bg_NguoiNhan' => $request->slNguoiNhan,
    				'dv_MaDV' => $request->slDonVi,
    				'p_MaPhong' => $request->slPhong
    			]);
    		return response()->json([
    			$data = 1
    		],200);
    	}catch(Exception $e){
    		return response()->json([
    			$data = 2
    		],200);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$Y = date('Y');
    	$TaiSan = DB::table('bangiao')->select('ts_MaTS')->where('bg_MaBG',$id)->get();
    	DB::table('taisan_'.$Y)->where('ts_MaTS', $TaiSan[0]->ts_MaTS)->update(['ts_HieuLuc' => 0]);
    	if(DB::table('bangiao')->where('bg_MaBG',$id)->delete()){
    		return response()->json([
    			$data = 1
    		],200);
    	}else{
    		return response()->json([
    			$data = 0
    		],200);
    	}
    }
}
