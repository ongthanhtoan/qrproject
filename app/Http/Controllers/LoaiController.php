<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loai;
use App\TaiSan;
use DB;
class LoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Loai = Loai::all();
        return view('backend.loai.index')->with('danhsachloai',$Loai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Loai::where('l_TenLoai',$request->l_TenLoai)->first()){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $Loai = new Loai();
            $Loai->l_TenLoai = $request->l_TenLoai;
            $Loai->l_GhiChu = $request->l_GhiChu;
            if($Loai->save()){
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
        $Loai = Loai::find($id);
        return response()->json([
            $data = $Loai
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
        $Check = DB::table('loai')->where('l_MaLoai','<>',$id)->where('l_TenLoai',$request->l_TenLoai)->get();
        if(count($Check)>0){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $Loai = Loai::find($id);
            $Loai->l_TenLoai = $request->l_TenLoai;
            $Loai->l_GhiChu = $request->l_GhiChu;
            if($Loai->save()){
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
        $Year = date('Y');
        $parent = DB::table('taisan_'.$Year)->where('l_MaLoai',$id)->count();
        if($parent == 0){
            $Loai = Loai::where('l_MaLoai', $id)->first();
            if($Loai->delete()){
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
        $Loai = DB::table('loai')->count();
        return $Loai;
    }
}
