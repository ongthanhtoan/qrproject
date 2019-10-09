<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phong;
use App\TaiSan;
use DB;
class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Phong = Phong::all();
        return view('backend.phong.index')->with('danhsachphong',$Phong);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.phong.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Phong::where('p_TenPhong',$request->p_TenPhong)->first()){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $Phong = new Phong();
            $Phong->p_TenPhong = $request->p_TenPhong;
            if($Phong->save()){
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
        $Phong = Phong::find($id);
        return response()->json([
            $data = $Phong
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
        $Check = DB::table('phong')->where('p_TenPhong',$request->p_TenPhong)->where('p_MaPhong','<>',$id)->get();
        if(count($Check)>0){
            return response()->json([
                $data = 0
            ],200);
        }else{
            $Phong = Phong::find($id);
            $Phong->p_TenPhong = $request->p_TenPhong;
            if($Phong->save()){
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
        $parent = DB::table('bangiao')->where('p_MaPhong',$id)->count();
        if($parent == 0){
            $Phong = Phong::where('p_MaPhong', $id)->first();
            if($Phong->delete()){
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
        $Phong = DB::table('phong')->count();
        return $Phong;
    }
}
