<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonVi;
use App\TaiSan;
use DB;
class DonViController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$DonVi = DonVi::all();
    	return view('backend.donvi.index')->with('danhsachdonvi',$DonVi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('backend.donvi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if(DonVi::where('dv_TenDV',$request->dv_TenDV)->first()){
    		return response()->json([
    			$data = 0
    		],200);
    	}else{
    		$DonVi = new DonVi();
    		$DonVi->dv_TenDV = $request->dv_TenDV;
    		if($DonVi->save()){
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
    	$DonVi = DonVi::find($id);
        return response()->json([
                $data = $DonVi
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
    	$Check = DB::table('donvi')->where('dv_TenDV',$request->dv_TenDV)->where('dv_MaDV','<>',$id)->get();
    	if(count($Check)>0){
    		return response()->json([
    			$data = 0
    		],200);
    	}else{
    		$DonVi = DonVi::find($id);
    		$DonVi->dv_TenDV = $request->dv_TenDV;
    		if($DonVi->save()){
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
        $parent = DB::table('bangiao')->where('dv_MaDV',$id)->count();
        if($parent == 0){
            $DonVi = DonVi::where('dv_MaDV', $id)->first();
            if($DonVi->delete()){
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
        $DonVi = DB::table('donvi')->count();
        return $DonVi;
    }
}
