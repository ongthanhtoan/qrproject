<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class KiemKeController extends Controller
{
	public function show($id){
		$Year = date('Y');
		$TaiSan = DB::table('taisan_'.$Year)
		->join('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
		->join('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
		->join('canbo','taisan_'.$Year.'.cb_TenDangNhap','=', 'canbo.cb_TenDangNhap')
		->where('ts_MaTS',$id)
		->get();
		return view('backend.taisan.show')->with('danhsachtaisan',$TaiSan);
	}
}
