<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loai;
use App\DonVi;
use App\HienTrang;
use App\Phong;
use DB;
use Excel;
use Schema;
use Session;
use App\Imports\TaiSanImport;
use App\Exports\TaiSanExport;
class TaiSanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Year = date('Y');
//        $TaiSan = DB::table('taisan_'.$Year)->select('taisan_'.$Year.'.ts_MaTS,ts_TenTS,ts_SoLuong,ts_NguyenGia,ts_Nam,ts_NgayKiemKe,ts_NangCap,ts_KiemKe,loai.l_MaLoai,l_TenLoai,hientrang.ht_MaHT,ht_TenHT,canbo.cb_TenDangNhap,ts_HieuLuc,bg_MaBG,
//')
//        ->join('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
//        ->join('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
//        ->join('canbo','taisan_'.$Year.'.cb_TenDangNhap','=', 'canbo.cb_TenDangNhap')
//        ->join('bangiao','taisan_'.$Year.'.ts_MaTS','=', 'bangiao.ts_MaTS')
//        ->get();
        $TaiSan = DB::select("SELECT
            a.ts_MaTS,
            a.ts_TenTS,
            a.ts_Nam,
            a.ts_KiemKe,
            a.ts_HieuLuc,
            a.ts_NangCap,
            a.ts_SoLuong,
            a.ts_NguyenGia,
            a.ts_NgayKiemKe,
            a.l_MaLoai,
            b.l_TenLoai,
            c.ht_MaHT,
            c.ht_TenHT,
            d.cb_HoTen,
            d.cb_TenDangNhap,
            e.bg_MaBG,
        CASE
            WHEN e.bg_MaBG IS NULL THEN
            1 ELSE 0 
        END AS da_ban_giao 
        FROM
            taisan_$Year a
            LEFT JOIN loai b ON a.l_MaLoai = b.l_MaLoai
            LEFT JOIN hientrang c ON a.ht_MaHT = c.ht_MaHT
            LEFT JOIN canbo d ON a.cb_TenDangNhap = d.cb_TenDangNhap
            LEFT JOIN bangiao e ON a.ts_MaTS = e.ts_MaTS 
        ORDER BY a.ts_MaTS");
        return view('backend.taisan.index')->with('danhsachtaisan',$TaiSan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Loai = Loai::all();
        $HienTrang = HienTrang::all();
        $CanBo = DB::table('canbo')->get();
        return view('backend.taisan.create')->with('dsLoai',$Loai)->with('dsHienTrang',$HienTrang)->with('dsCanBo',$CanBo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Year = date('Y');
        // comment by kthanh 01-09-2019: cho phép thêm tài sản trùng tên nhưng không trùng mã
        // $Check1 = DB::table('taisan_'.$Year)
        // ->where('ts_TenTS', '=',$request->ts_TenTS)->count();
        $Check = DB::table('taisan_'.$Year)
        ->Where('ts_MaTS','=',$request->ts_MaTS)->count();
        if($Check!=0){
            return response()->json([
                $data = 0
            ],200);
        }else{
            if(DB::table('taisan_'.$Year)->insert(
                [
                    'ts_MaTS' => $request->ts_MaTS,
                    'ts_TenTS' => $request->ts_TenTS,
                    'ts_SoLuong' => $request->ts_SoLuong,
                    'ts_NguyenGia' => $request->ts_NguyenGia,
                    'ts_Nam' => $request->ts_Nam,
                    'cb_TenDangNhap' => $request->slCanBo,
                    'ts_NgayKiemKe' => $request->ts_NgayKiemKe,
                    'ts_NangCap' => $request->ts_NangCap,
                    'l_MaLoai' => $request->slLoai,
                    'ht_MaHT' => $request->slHienTrang,
                    'ts_KiemKe' => $request->slKiemKe,
                    'ts_HieuLuc' => 0
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
        $Year = date('Y');
        $TaiSan = DB::table('taisan_'.$Year)
        ->join('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
        ->join('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
        ->join('canbo','taisan_'.$Year.'.cb_TenDangNhap','=', 'canbo.cb_TenDangNhap')
        ->where('ts_MaTS',$id)
        ->get();
        return $TaiSan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Year = date('Y');
        $TaiSan = DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->first();
        $Loai = Loai::all();
        $HienTrang = HienTrang::all();
        $CanBo = DB::table('canbo')->get();
        return view('backend.taisan.edit')->with('taisan',$TaiSan)
        ->with('dsLoai',$Loai)->with('dsHienTrang',$HienTrang)->with('dsCanBo',$CanBo);
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
        $Year = date('Y');
        try{
            DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->update(
                [
                    'ts_TenTS' => $request->ts_TenTS,
                    'ts_SoLuong' => $request->ts_SoLuong,
                    'ts_NguyenGia' => $request->ts_NguyenGia,
                    'ts_Nam' => $request->ts_Nam,
                    'cb_TenDangNhap' => $request->slCanBo,
                    'ts_NgayKiemKe' => $request->ts_NgayKiemKe,
                    'ts_NangCap' => $request->ts_NangCap,
                    'l_MaLoai' => $request->slLoai,
                    'ht_MaHT' => $request->slHienTrang,
                    'ts_KiemKe' => $request->slKiemKe
                ]
            );
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
        $Year = date('Y');
        if(DB::table('taisan_'.$Year)->where('ts_MaTS', $id)->delete()){
            return response()->json([
                $data = 1
            ],200);
        }else{
            return response()->json([
                $data = 0
            ],200);
        }
    }
    public function getReset()
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        return view('backend.taisan.reset')->with('table',$tables);
    }
    public function postReset(Request $request){
        $tablename = $request->txtNamTS;
        try{
            if (Schema::hasTable($tablename)){
                Schema::dropIfExists($tablename);
                Schema::connection('mysql')->create($tablename, function($table)
                {
                    $table->string('ts_MaTS')->unique();
                    $table->unsignedTinyInteger('l_MaLoai');
                    $table->text('ts_TenTS');
                    $table->integer('ts_SoLuong');
                    $table->integer('ts_NguyenGia');
                    $table->string('ts_Nam');
                    $table->text('ts_NangCap')->nullable();
                    $table->unsignedTinyInteger('ts_KiemKe');
                    $table->unsignedTinyInteger('ht_MaHT');
                    $table->primary('ts_MaTS');
                    $table -> foreign("l_MaLoai") -> references("l_MaLoai") -> on("loai")->onUpdate('CASCADE');
                    $table -> foreign("ht_MaHT") -> references("ht_MaHT") -> on("hientrang")->onUpdate('CASCADE');
                });
                $NamCapNhat = $request->NamTS_CapNhat;
                $temps = DB::table($NamCapNhat)->get();
                foreach ($temps as $temp) {
                    DB::table($tablename )->insert(
                        [
                            'ts_MaTS' => $temp->ts_MaTS,
                            'l_MaLoai' => $temp->l_MaLoai,
                            'ts_TenTS' => $temp->ts_TenTS,
                            'ts_SoLuong' => $temp->ts_SoLuong,
                            'ts_NguyenGia' => $temp->ts_NguyenGia,
                            'ts_Nam' => $temp->ts_Nam,
                            'ts_NangCap' => $temp->ts_NangCap,
                            'ht_MaHT' => $temp->ht_MaHT,
                            'ts_KiemKe' => 0,
                        ]
                    );
                }
                return response()->json([
                    $data = 1
                ],200);
            }else{
                Schema::connection('mysql')->create($tablename, function($table)
                {
                    $table->string('ts_MaTS')->unique();
                    $table->unsignedTinyInteger('l_MaLoai');
                    $table->text('ts_TenTS');
                    $table->integer('ts_SoLuong');
                    $table->integer('ts_NguyenGia');
                    $table->string('ts_Nam');
                    $table->text('ts_NangCap')->nullable();
                    $table->unsignedTinyInteger('ts_KiemKe');
                    $table->unsignedTinyInteger('ht_MaHT');
                    $table->primary('ts_MaTS');
                    $table -> foreign("l_MaLoai") -> references("l_MaLoai") -> on("loai")->onUpdate('CASCADE');
                    $table -> foreign("ht_MaHT") -> references("ht_MaHT") -> on("hientrang")->onUpdate('CASCADE');
                });
                $NamCapNhat = $request->NamTS_CapNhat;
                $temps = DB::table($NamCapNhat)->get();
                foreach ($temps as $temp) {
                    DB::table($tablename )->insert(
                        [
                            'ts_MaTS' => $temp->ts_MaTS,
                            'l_MaLoai' => $temp->l_MaLoai,
                            'ts_TenTS' => $temp->ts_TenTS,
                            'ts_SoLuong' => $temp->ts_SoLuong,
                            'ts_NguyenGia' => $temp->ts_NguyenGia,
                            'ts_Nam' => $temp->ts_Nam,
                            'ts_NangCap' => $temp->ts_NangCap,
                            'ht_MaHT' => $temp->ht_MaHT,
                            'ts_KiemKe' => 0,
                        ]
                    );
                }
                return response()->json([
                    $data = 1
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                $data = 0
            ],200);
        }
    }
    public function kiemKe($id){
        $Date = date("m/d/Y"); // Tháng ngày năm
        $Year = date('Y');
        $Info = "";
        if(Session::has('admin')){
            $User = DB::table('users')->where('username',Session::get('admin'))->get();
            $CanBo = DB::table('canbo')->where('cb_TenDangNhap',$User[0]->username)->count();
            if($CanBo == 0){
                Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê, Vui Lòng Thêm Tài Khoản Của Bạn Vào Trong Phần Quản Lý Cán Bộ Và Cấp Quyền Kiểm Kê!!!');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }else{
                $CheckQuyen = DB::table('canbo')->where('cb_TenDangNhap',$User[0]->username)->where('cb_KiemKe',1)->count();
                if($CheckQuyen != 0){
                    $Info = Session::get('admin');
                    if(DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->update(
                        [
                            'cb_TenDangNhap'=> $Info,
                            'ts_NgayKiemKe' => $Date,
                            'ts_KiemKe'=> 1
                        ]
                    )){
                        Session::flash('alert-success', 'Đã Kiểm Kê');
                        return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                    }else{
                        Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê');
                        return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                    }
                }else{
                    Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê, Vui Lòng Thêm Tài Khoản Của Bạn Vào Trong Phần Quản Lý Cán Bộ Và Cấp Quyền Kiểm Kê!!!');
                    return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                }
            }
        }else if(Session::has('user')){
            $rd = Session::get('user');
            $Info = $rd['username'];
            if(DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->update(
                [
                    'cb_TenDangNhap'=> $Info,
                    'ts_NgayKiemKe' => $Date,
                    'ts_KiemKe'=> 1
                ]
            )){
                Session::flash('alert-success', 'Đã Kiểm Kê');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }else{
                Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }
        }
    }
    public function huyKiemKe($id){
        $Date = date("m/d/Y"); // Tháng ngày năm
        $Year = date('Y');
        $Info = "";
        if(Session::has('admin')){
            $User = DB::table('users')->where('username',Session::get('admin'))->get();
            $CanBo = DB::table('canbo')->where('cb_TenDangNhap',$User[0]->username)->count();
            if($CanBo == 0){
                Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê, Vui Lòng Thêm Tài Khoản Của Bạn Vào Trong Phần Quản Lý Cán Bộ Và Cấp Quyền Kiểm Kê!!!');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }else{
                $CheckQuyen = DB::table('canbo')->where('cb_TenDangNhap',$User[0]->username)->where('cb_KiemKe',1)->count();
                if($CheckQuyen != 0){
                    $Info = Session::get('admin');
                    if(DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->update(
                        [
                            'cb_TenDangNhap'=> $Info,
                            'ts_NgayKiemKe' => $Date,
                            'ts_KiemKe'=> 0
                        ]
                    )){
                        Session::flash('alert-danger', 'Đã Huy Kiểm Kê');
                        return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                    }else{
                        Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê');
                        return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                    }
                }else{
                    Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê, Vui Lòng Thêm Tài Khoản Của Bạn Vào Trong Phần Quản Lý Cán Bộ Và Cấp Quyền Kiểm Kê!!!');
                    return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
                }
            }
        }else if(Session::has('user')){
            $rd = Session::get('user');
            $Info = $rd['username'];
            if(DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->update(
                [
                    'cb_TenDangNhap'=> $Info,
                    'ts_NgayKiemKe' => $Date,
                    'ts_KiemKe'=> 0
                ]
            )){
                Session::flash('alert-danger', 'Đã Hủy Kiểm Kê');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }else{
                Session::flash('alert-danger', 'Lỗi, Có Lẽ Bạn Chưa Được Cấp Quyền Kiểm Kê');
                return redirect()->route('kiem-ke-tai-san.show',['id'=>$id]);
            }
        }
    }
    public function getImport(){
        return view('backend.taisan.import');
    }
    public function postImport(Request $request){
        $loi = Array();
        $file =$request->file->store('temp');
		$path=storage_path('app').'/'.$file;
        if(!empty($file)){
            //$original_name = $path->getClientOriginalName();
            //if($original_name == "themtaisantufile.xlsx")
            //{
                //$file_path = $file->getPathName();
                Excel::import(new TaiSanImport, $path);
                return back();
            //}else{
                //$loi[] = "File excel không đúng định dạng, vui lòng sử dụng file mẫu để thêm.";
            //}
        }else{
            $loi[] = "Vui lòng chọn file.";
        }
        Session::flash('message', $loi);
        return redirect()->route('tai-san.index');
        
    }
    public function getExport(){
        return Excel::download(new TaiSanExport, 'danhsachtaisan_'.date("Y.m.d").'.xlsx');
    }
    public function load(){
        $Year = date('Y');
        $TaiSan = DB::table('taisan_'.$Year)->count();
        return $TaiSan;
    }
    
    public function deleteMultiple(Request $request){
        
        $Year = date('Y');
        $ids = $request->ids;
        $temp = explode(",",$ids);
        $checkTS = DB::table('bangiao')->select('ts_MaTS')->whereIn('ts_MaTS',$temp)->get();
        foreach ($checkTS as $key => $value) {
            foreach ($temp as $k => $v) {
                if($value->ts_MaTS == $v){
                    unset($temp[$k]);
                }
            }
        }
        $success = implode(", ", $temp);
        if(DB::table('taisan_'.$Year)->whereIn('ts_MaTS',$temp)->delete()){
            return response()->json(['status'=>true,'message'=>"Xóa thành công tài sản $success"]);
        }else{
            return response()->json(['status'=>true,'message'=>"Lỗi thử lại sau!"]);
        }
    }
}
