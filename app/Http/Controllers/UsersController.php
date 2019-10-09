<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = DB::table('users')->get();
        return view('backend.quantri.index')->with('danhsachuser',$User);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(DB::table('users')->where('HoTen',$request->HoTen)->first()){
            return response()->json([
                $data = 0
            ],200);
        }else{
            if($User = DB::table('users')->insert(
                [
                    'HoTen'=>$request->HoTen,
                    'username'=>$request->username,
                    'password'=>bcrypt($request->password)
                ]
            )){
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

        $User=DB::table('users')->where('username',$id)->get();

        return response()->json([
            $data =$User
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
        $Check = DB::table('users')->where('HoTen',$request->HoTen)->where('username','<>',$id)->get();
        if(count($Check)!=0)
        {
            return response()->json([
                $data = 0
            ],200);
        }
        else
        {
            if($request->password == null && $request->passwordnew == null)
            {
                DB::table('users')->where('username',$id)->update(
                    [
                        'HoTen'=>$request->HoTen,'username'=>$request->username
                    ]);
                return response()->json([
                    $data = 1
                ],200);
            }
            if($request->password != null && $request->passwordnew != null)
            {
                $User = DB::table('users')->where('username',$id)->get();
                if(Hash::check($request->password,$User[0]->password))
                {
                    DB::table('users')->where('username',$id)->update(
                        [
                            'HoTen'=>$request->HoTen,
                            'username'=>$request->username,
                            'password'=>bcrypt($request->passwordnew)
                        ]
                    );
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table('users')->where('username',$id)->delete()){
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
