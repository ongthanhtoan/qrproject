<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class NhatKyController extends Controller
{
    public function index($tuNgay = '', $denNgay = '') {
        if(Session::has('data')){
            $data = Session::get('data');
            Session::forget('data');
            return view('backend.nhatky.index')->with('data',$data);
        }else{
            $data = DB::table('nhatky')->get();
            return view('backend.nhatky.index')->with('data',$data);
        }
    	
    }
    public function index_search(Request $request) {
        Session::forget('data');
        $tuNgay = $request->tuNgay;
        $denNgay = $request->denNgay;
        $tuNgay = strtotime($tuNgay);
        $denNgay = strtotime($denNgay);
        $data = DB::table('nhatky')->whereBetween('nk_ThoiGian', [$tuNgay, $denNgay])->get();
        Session::put('data',$data);
        return response()->json([
            $data = 1
        ],200);
    }
}
