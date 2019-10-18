<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\HienTrang;
use App\DonVi;
use App\Phong;
use Carbon\Carbon;
class BanGiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
    	$Y = date('Y');
    	$CanBo = DB::table('canbo')->get();
    	$bangiao = DB::table('bangiao')
    	->join('taisan_'.$Y,'bangiao.ts_MaTS','=','taisan_'.$Y.'.ts_MaTS')
    	->join('donvi','bangiao.dv_MaDV','=','donvi.dv_MaDV')
    	->join('phong','bangiao.p_MaPhong','=','phong.p_MaPhong')->get();
    	return view('backend.bangiao.index')->with('dsBanGiao',$bangiao)->with('dsCanBo',$CanBo);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$Y = date('Y');
        // lấy những tài sản chưa bàn giao
        //
    	$TaiSan = DB::table('taisan_'.$Y)->where('ts_HieuLuc',0)->get();
    	$HienTrang = HienTrang::all();
    	$DonVi = DonVi::all();
    	$Phong = Phong::all();
    	$CanBo = DB::table('canbo')->get();
    	return view('backend.bangiao.create')->with('dsTaiSan',$TaiSan)->with('dsHienTrang',$HienTrang)->with('dsDonVi',$DonVi)->with('dsPhong',$Phong)->with('dsCanBo',$CanBo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$Y = date('Y');
        DB::table('bangiao')->insert(
            [
                    'ts_MaTS' => $request->slTaiSan,
                    'bg_NgayGiao' => $request->bg_NgayGiao,
                    'bg_NguoiGiao' => $request->slNguoiGiao,
                    'bg_NgayNhan' => $request->bg_NgayNhan,
                    'bg_NguoiNhan' => $request->slNguoiNhan,
                    'dv_MaDV' => $request->slDonVi,
                    'p_MaPhong' => $request->slPhong,
            ]);
        $id = DB::getPdo()->lastInsertId();
    	if($id != ""){
    		DB::table('taisan_'.$Y)->where('ts_MaTS', $request->slTaiSan)->update(['ts_HieuLuc' => 1]);
                //Ghi log
                $infoCu = DB::table('bangiao')->where('ts_MaTS',$request->slTaiSan)->where('bg_NguoiNhan','<>',$request->slNguoiNhan)->get();
                $DonVi = new DonVi();
                $Phong = new Phong();
                $DonVi = $DonVi->getTenById($request->slDonVi);
                $tenDonVi = $DonVi[0]->dv_TenDV;
                $Phong = $Phong->getTenById($request->slPhong);
                $tenPhong = $Phong[0]->p_TenPhong;
                $thoiGian = now()->timestamp;
                $noiDung = "";
                if(count($infoCu) > 0){
                    $nguoiNhanCu = $infoCu[0]->bg_NguoiNhan;
                    $ngayNhanCu = $infoCu[0]->bg_NgayNhan;
                    $noiDung = " Tài sản $request->slTaiSan trước đó của $nguoiNhanCu nhận vào ngày $ngayNhanCu";
                }
                $data = Array([
                    'nk_MaDanhMuc' => $request->slTaiSan,
                    'nk_NoiDung' => "Bàn giao tài sản $request->slTaiSan cho cán bộ $request->slNguoiNhan Ngày nhận $request->bg_NgayNhan, Người giao $request->slNguoiGiao, Ngày giao $request->bg_NgayGiao Đơn vị: $tenDonVi, Phòng: $tenPhong $noiDung",
                    'nk_ChucNang' => "Thêm",
                    'nk_ThoiGian' => $thoiGian
                ]);
                DB::table('nhatky')->insert($data);
    		return response()->json([
    			$data = 1
    		],200);
    	}else{
    		return response()->json([
    			$data = 2
    		],200);
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
    	$Y = date('Y');
    	$BanGiao = DB::table('bangiao')->where('bg_MaBG',$id)->first();
    	$TaiSan = DB::table('taisan_'.$Y)->get();
    	$HienTrang = HienTrang::all();
    	$DonVi = DonVi::all();
    	$Phong = Phong::all();
    	$CanBo = DB::table('canbo')->get();
    	return view('backend.bangiao.edit')->with('dsTaiSan',$TaiSan)->with('dsHienTrang',$HienTrang)->with('dsDonVi',$DonVi)->with('dsPhong',$Phong)->with('dsCanBo',$CanBo)->with('BanGiao',$BanGiao);
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
    	try{
            //Ghi log
            $infoCu = DB::table('bangiao')->where('bg_MaBG',$id)->get();
            $DonVi = new DonVi();
            $Phong = new Phong();
            $DonVi = $DonVi->getTenById($request->slDonVi);
            $tenDonVi = $DonVi[0]->dv_TenDV;
            $Phong = $Phong->getTenById($request->slPhong);
            $tenPhong = $Phong[0]->p_TenPhong;
            $thoiGian = now()->timestamp;
            $noiDung = "";
            if(count($infoCu) > 0){
                $nguoiNhanCu = $infoCu[0]->bg_NguoiNhan;
                $ngayNhanCu = $infoCu[0]->bg_NgayNhan;
                $noiDung = " Tài sản $request->slTaiSan trước đó của $nguoiNhanCu nhận vào ngày $ngayNhanCu";
            }
            $data = Array([
                'nk_MaDanhMuc' => $request->slTaiSan,
                'nk_NoiDung' => "Cập nhật bàn giao tài sản $request->slTaiSan cho cán bộ $request->slNguoiNhan Ngày nhận $request->bg_NgayNhan, Người giao $request->slNguoiGiao, Ngày giao $request->bg_NgayGiao Đơn vị: $tenDonVi, Phòng: $tenPhong $noiDung",
                'nk_ChucNang' => "Sửa",
                'nk_ThoiGian' => $thoiGian
            ]);
            DB::table('nhatky')->insert($data);
            DB::table('bangiao')->where('bg_MaBG', $id)->update(
                    [
                            'ts_MaTS' => $request->slTaiSan,
                            'bg_NgayGiao' => $request->bg_NgayGiao,
                            'bg_NguoiGiao' => $request->slNguoiGiao,
                            'bg_NgayNhan' => $request->bg_NgayNhan,
                            'bg_NguoiNhan' => $request->slNguoiNhan,
                            'dv_MaDV' => $request->slDonVi,
                            'p_MaPhong' => $request->slPhong
                    ]);
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
    	$Y = date('Y');
    	$TaiSan = DB::table('bangiao')->select('ts_MaTS')->where('bg_MaBG',$id)->get();
    	DB::table('taisan_'.$Y)->where('ts_MaTS', $TaiSan[0]->ts_MaTS)->update(['ts_HieuLuc' => 0]);
    	if(DB::table('bangiao')->where('bg_MaBG',$id)->delete()){
            return response()->json([
                    $data = 1
            ],200);
    	}else{
            return response()->json([
                    $data = 0
            ],200);
    	}
    }
    public function deleteMultiple(Request $request){
        $Y = date('Y');
        $ids = $request->ids;
        $temp = explode(",",$ids);
        $success = implode(", ", $temp);
        foreach ($temp as $key => $value) {
            if($value != ""){
                $TaiSan = DB::table('bangiao')->select('ts_MaTS')->where('bg_MaBG',$value)->get();
                //Ghi log
                $infoCu = DB::table('bangiao')->where('bg_MaBG',$value)->get();
                $thoiGian = now()->timestamp;
                $noiDung = "";
                if(count($infoCu) > 0){
                    $maTS = $infoCu[0]->ts_MaTS;
                    $nguoiNhanCu = $infoCu[0]->bg_NguoiNhan;
                    $ngayNhanCu = $infoCu[0]->bg_NgayNhan;
                    $noiDung = " Tài sản $maTS trước đó của $nguoiNhanCu nhận vào ngày $ngayNhanCu";
                }
                $data = Array([
                    'nk_MaDanhMuc' => $maTS,
                    'nk_NoiDung' => "Xóa tài sản được bàn giao $maTS $noiDung",
                    'nk_ChucNang' => "Xóa",
                    'nk_ThoiGian' => $thoiGian
                ]);
                DB::table('nhatky')->insert($data);
                if(DB::table('bangiao')->where('bg_MaBG',$value)->delete()){
                    DB::table('taisan_'.$Y)->where('ts_MaTS', $TaiSan[0]->ts_MaTS)->update(['ts_HieuLuc' => 0]);
                }else{
//                    return response()->json(['status'=>true,'message'=>"Lỗi thử lại sau!"]);
                }
            }
        }
        return response()->json(['status'=>true,'message'=>"Xóa thành công các dòng được chọn."]);
    }
}
