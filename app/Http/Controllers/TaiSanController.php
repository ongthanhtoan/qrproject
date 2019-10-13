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
use Carbon\Carbon;
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
        $TaiSan = DB::table('taisan_'.$Year)
        ->join('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
        ->join('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
        ->join('canbo','taisan_'.$Year.'.cb_TenDangNhap','=', 'canbo.cb_TenDangNhap')
        ->get();
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
//        dd($tables);
        return view('backend.taisan.reset')->with('table',$tables);
    }
    public function postReset(Request $request){
        $tablename = "taisan_".$request->txtNamTS;
        try{
            if (Schema::hasTable($tablename)){
                Schema::dropIfExists($tablename);
                Schema::connection('mysql')->create($tablename, function($table)
                {
                    $table->string('ts_MaTS');
                    $table->primary('ts_MaTS');
                    $table->text('ts_TenTS');
                    $table->integer('ts_SoLuong');
                    $table->integer('ts_NguyenGia');
                    $table->string('ts_Nam');
                    $table->string('ts_NgayKiemKe');
                    $table->text('ts_NangCap')->nullable();
                    $table->unsignedTinyInteger('ts_KiemKe');
                    $table->unsignedTinyInteger('l_MaLoai');
                    $table->unsignedTinyInteger('ht_MaHT');
                    $table->string('cb_TenDangNhap');
                    $table->integer('ts_HieuLuc')->nullable();;
                    $table -> foreign("l_MaLoai") -> references("l_MaLoai") -> on("loai")->onUpdate('CASCADE');
                    $table -> foreign("ht_MaHT") -> references("ht_MaHT") -> on("hientrang")->onUpdate('CASCADE');
                    $table -> foreign("cb_TenDangNhap") -> references("cb_TenDangNhap") -> on("canbo")->onUpdate('CASCADE');
                });
                $NamCapNhat = $request->NamTS_CapNhat;
                $temps = DB::table($NamCapNhat)->get();
                foreach ($temps as $temp) {
                    DB::table($tablename )->insert(
                        [
                            'ts_MaTS' => $temp->ts_MaTS,
                            'ts_TenTS' => $temp->ts_TenTS,
                            'ts_SoLuong' => $temp->ts_SoLuong,
                            'ts_NguyenGia' => $temp->ts_NguyenGia,
                            'ts_Nam' => $temp->ts_Nam,
                            'cb_TenDangNhap' => $temp->cb_TenDangNhap,
                            'ts_NgayKiemKe' => $temp->ts_NgayKiemKe,
                            'ts_NangCap' => $temp->ts_NangCap,
                            'l_MaLoai' => $temp->l_MaLoai,
                            'ht_MaHT' => $temp->ht_MaHT,
                            'ts_KiemKe' => 0,
                            'ts_HieuLuc' => 0
                        ]
                    );
                }
                return response()->json([
                    $data = 1
                ],200);
            }else{
                Schema::connection('mysql')->create($tablename, function($table)
                {
                    $table->string('ts_MaTS');
                    $table->primary('ts_MaTS');
                    $table->text('ts_TenTS');
                    $table->integer('ts_SoLuong');
                    $table->integer('ts_NguyenGia');
                    $table->string('ts_Nam');
                    $table->string('ts_NgayKiemKe');
                    $table->text('ts_NangCap')->nullable();
                    $table->unsignedTinyInteger('ts_KiemKe');
                    $table->unsignedTinyInteger('l_MaLoai');
                    $table->unsignedTinyInteger('ht_MaHT');
                    $table->string('cb_TenDangNhap');
                    $table->integer('ts_HieuLuc')->nullable();;
                    $table -> foreign("l_MaLoai") -> references("l_MaLoai") -> on("loai")->onUpdate('CASCADE');
                    $table -> foreign("ht_MaHT") -> references("ht_MaHT") -> on("hientrang")->onUpdate('CASCADE');
                    $table -> foreign("cb_TenDangNhap") -> references("cb_TenDangNhap") -> on("canbo")->onUpdate('CASCADE');
                });
                $NamCapNhat = $request->NamTS_CapNhat;
                $temps = DB::table($NamCapNhat)->get();
                foreach ($temps as $temp) {
                    DB::table($tablename )->insert(
                        [
                            'ts_MaTS' => $temp->ts_MaTS,
                            'ts_TenTS' => $temp->ts_TenTS,
                            'ts_SoLuong' => $temp->ts_SoLuong,
                            'ts_NguyenGia' => $temp->ts_NguyenGia,
                            'ts_Nam' => $temp->ts_Nam,
                            'cb_TenDangNhap' => $temp->cb_TenDangNhap,
                            'ts_NgayKiemKe' => $temp->ts_NgayKiemKe,
                            'ts_NangCap' => $temp->ts_NangCap,
                            'l_MaLoai' => $temp->l_MaLoai,
                            'ht_MaHT' => $temp->ht_MaHT,
                            'ts_KiemKe' => 0,
                            'ts_HieuLuc' => $temp->ts_HieuLuc
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
                        //Ghi log
                        $infoTS = DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->get();
                        $maTS = $infoTS[0]->ts_MaTS;
                        $tenTS = $infoTS[0]->ts_TenTS;
                        $soLuong = $infoTS[0]->ts_SoLuong;
                        $canBo = $infoTS[0]->cb_TenDangNhap;
                        $thoiGian = Carbon::parse(date('d-m-Y'))->timestamp;
                        $data = Array([
                            'nk_MaDanhMuc' => $maTS,
                            'nk_NoiDung' => "Kiểm kê tài sản $maTS - $tenTS, Số lượng: $soLuong, Người kiểm kê: $canBo",
                            'nk_ChucNang' => "Kiểm kê",
                            'nk_ThoiGian' => $thoiGian
                        ]);
                        DB::table('nhatky')->insert($data);
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
                //Ghi log
                $infoTS = DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->get();
                $maTS = $infoTS[0]->ts_MaTS;
                $tenTS = $infoTS[0]->ts_TenTS;
                $soLuong = $infoTS[0]->ts_SoLuong;
                $canBo = $infoTS[0]->cb_TenDangNhap;
                $thoiGian = Carbon::parse(date('d-m-Y'))->timestamp;
                $data = Array([
                    'nk_MaDanhMuc' => $maTS,
                    'nk_NoiDung' => "Kiểm kê tài sản $maTS - $tenTS, Số lượng: $soLuong, Người kiểm kê: $canBo",
                    'nk_ChucNang' => "Kiểm kê",
                    'nk_ThoiGian' => $thoiGian
                ]);
                DB::table('nhatky')->insert($data);
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
                        //Ghi log
                        $infoTS = DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->get();
                        $maTS = $infoTS[0]->ts_MaTS;
                        $tenTS = $infoTS[0]->ts_TenTS;
                        $soLuong = $infoTS[0]->ts_SoLuong;
                        $canBo = $infoTS[0]->cb_TenDangNhap;
                        $thoiGian = Carbon::parse(date('d-m-Y'))->timestamp;
                        $data = Array([
                            'nk_MaDanhMuc' => $maTS,
                            'nk_NoiDung' => "Bỏ kiểm kê tài sản $maTS - $tenTS, Số lượng: $soLuong, Người kiểm kê: $canBo",
                            'nk_ChucNang' => "Bỏ kiểm kê",
                            'nk_ThoiGian' => $thoiGian
                        ]);
                        DB::table('nhatky')->insert($data);
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
                //Ghi log
                $infoTS = DB::table('taisan_'.$Year)->where('ts_MaTS',$id)->get();
                $maTS = $infoTS[0]->ts_MaTS;
                $tenTS = $infoTS[0]->ts_TenTS;
                $soLuong = $infoTS[0]->ts_SoLuong;
                $canBo = $infoTS[0]->cb_TenDangNhap;
                $thoiGian = Carbon::parse(date('d-m-Y'))->timestamp;
                $data = Array([
                    'nk_MaDanhMuc' => $maTS,
                    'nk_NoiDung' => "Bỏ kiểm kê tài sản $maTS - $tenTS, Số lượng: $soLuong, Người bỏ kiểm kê: $canBo",
                    'nk_ChucNang' => "Bỏ kiểm kê",
                    'nk_ThoiGian' => $thoiGian
                ]);
                DB::table('nhatky')->insert($data);
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
        $file =$request->file;
        if(!empty($file)){
            $file2 = $request->file->store('temp');
            $path=storage_path('app').'/'.$file2;
            $original_name = $file->getClientOriginalName();
            if($original_name == "themtaisantufile.xlsx")
            {
                //$file_path = $file->getPathName();
                Excel::import(new TaiSanImport, $path);
                return back();
            }else{
                $loi[] = "File excel không đúng định dạng, vui lòng sử dụng file mẫu để thêm.";
            }
        }else{
            $loi[] = "Vui lòng chọn file excel cần thêm.";
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
        $error = $checkTS->implode('ts_MaTS', ', ');
        if(DB::table('taisan_'.$Year)->whereIn('ts_MaTS',$temp)->delete()){
            return response()->json(['status'=>true,'message'=>"Xóa thành công tài sản $success"]);
        }else{
            return response()->json(['status'=>true,'message'=>"Lỗi thử lại sau!"]);
        }
    }
}
