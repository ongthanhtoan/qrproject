<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HienTrang;
use App\TaiSan;
use DB;
class HienTrangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $HienTrang = HienTrang::all();
        return view('backend.hientrang.index')->with('danhsachhientrang',$HienTrang);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.hientrang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(HienTrang::where('ht_TenHT',$request->ht_TenHT)->first()){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $HienTrang = new HienTrang();
            $HienTrang->ht_TenHT = $request->ht_TenHT;
            if($HienTrang->save()){
                return response()->json([
                    $data = 1
                ],200);
            }else{
                return response()->json([
                    $data = 2
                ],200);
            }
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
        $HienTrang = HienTrang::find($id);
        return response()->json([
            $data = $HienTrang
        ],200);
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
        $Check = DB::table('hientrang')->where('ht_MaHT','<>',$id)->where('ht_TenHT',$request->ht_TenHT)->get();
        if(count($Check)>0){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $HienTrang = HienTrang::find($id);
            $HienTrang->ht_TenHT = $request->ht_TenHT;
            if($HienTrang->save()){
                return response()->json([
                    $data = 1
                ],200);
            }else{
                return response()->json([
                    $data = 2
                ],200);
            }
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
        $parent = DB::table('taisan_'.date('Y'))->where('ht_MaHT',$id)->count();
        if($parent == 0){
            $HienTrang = HienTrang::where('ht_MaHT', $id)->first();
            if($HienTrang->delete()){
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
    public function load(){
        $HienTrang = DB::table('hientrang')->count();
        return $HienTrang;
    }
}
