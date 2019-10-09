<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class HomeController extends Controller
{
	public function index(){
		if(Session::has('admin')){
			return view('backend.home.index')->with('home','home');
		}
	}
	public function CountTaiSan(){
		$TaiSan = DB::table('taisan_2019')->count();
		return $TaiSan;
	}
	public function CountLoai(){
		$Loai = DB::table('loai')->count();
		return $Loai;
	}
	public function CountDonVi(){
		$DonVi = DB::table('donvi')->count();
		return $DonVi;
	}
	public function CountPhong(){
		$Phong = DB::table('phong')->count();
		return $Phong;
	}
	public function CountHienTrang(){
		$HienTrang = DB::table('hientrang')->count();
		return $HienTrang;
	}
	public function CountCanBo(){
		$CanBo = DB::table('canbo')->count();
		return $CanBo;
	}
	public function CountUser(){
		$User = DB::table('users')->count();
		return $User;
	}
	public function CountBanGiao(){
		$BanGiao = DB::table('bangiao')->count();
		return $BanGiao;
	}
	public function dsBanGiao(){
		$User = Session::get('user');
		$Y = date('Y');
		$CanBo = DB::table('canbo')->get();
		$BanGiao = DB::table('bangiao')
		->join('taisan_'.$Y,'bangiao.ts_MaTS','=','taisan_'.$Y.'.ts_MaTS')
		->join('donvi','bangiao.dv_MaDV','=','donvi.dv_MaDV')
		->join('phong','bangiao.p_MaPhong','=','phong.p_MaPhong')
		->where('bg_NguoiNhan','=', $User['username'])->get();
		if(count($BanGiao) != 0){
			return view('backend.bangiao.index-user')->with('dsBanGiao',$BanGiao)->with('dsCanBo',$CanBo);
		}else{
			return view('backend.bangiao.index-user')->with('dsBanGiao',$BanGiao)->with('dsCanBo',$CanBo);
		}
	}
}
