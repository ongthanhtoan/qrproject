<?php

namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\Loai;
use App\HienTrang;
use Session;
use DateTime;
class TaiSanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
    	$Year = date('Y');
        $stt = 1;
        $err = Array();$loi = Array();
        for($i = 3; $i < count($rows); $i++){
            if(!empty($rows[$i])){
                $TaiSan = DB::table('taisan_'.$Year)->where('ts_MaTS',$rows[$i][1])->count();
                // $TaiSan2 = DB::table('taisan_'.$Year)->where('ts_TenTS',$rows[$i][2])->count();
                $Loai = DB::table('loai')->where('l_MaLoai',$rows[$i][3])->count();
                $HienTrang = DB::table('hientrang')->where('ht_MaHT', $rows[$i][9])->count();
                $CanBo = DB::table('canbo')->where('cb_TenDangNhap',$rows[$i][7])->count();
                $l = "";
                $ht = "";
                $u = "";
                $mats = "";
                $tents = $rows[$i][2];
                $sl = $rows[$i][4];
                $gia = $rows[$i][5];
                $nam = $rows[$i][6];
                $nangcap = $rows[$i][11];
                $ngaykk = $rows[$i][8];
                $kk = $rows[$i][10];
                if($TaiSan > 0){
                    $loi[] = "Dòng thứ ".$stt." Mã tài sản ".$rows[$i][1]." đã tồn tại.";
                }else {
                    $mats = $rows[$i][1];
                }
                if($tents == ""){
                    $loi[] = "Dòng thứ ".$stt." Tên tài sản không được bỏ trống.";
                }
                if($Loai == 0){
                    $loi[] = "Dòng thứ ".$stt." Mã loại ".$rows[$i][3]." không tồn tại trong hệ thống.";
                }else {
                    $l = $rows[$i][3];
                }
                if($HienTrang == 0){
                    $loi[] = "Dòng thứ ".$stt." Mã hiện trạng ".$rows[$i][9]." không tồn tại trong hệ thống.";
                }else{
                    $ht = $rows[$i][9];
                }
                if($CanBo == 0){
                    $loi[] = "Dòng thứ ".$stt." Mã cán bộ ".$rows[$i][7]." không tồn tại trong hệ thống.";
                }else {
                    $u =  $rows[$i][7];
                }
                if(!is_numeric($gia) || $gia == ""){
                    $loi[] = "Dòng thứ ".$stt." Nguyên giá phải là dạng số.";
                }
                if(!is_numeric($kk) || $kk < 0 | $kk > 1 || $kk == ""){
                    $loi[] = "Dòng thứ ".$stt." Giá trị của trường kiểm kê chỉ là 0 hoặc 1 .";
                }
                $stt++;
                if(empty($loi)){
                    $this->process_Them($mats, $tents, $l, $ht, $u, $gia, $sl, $nam, $nangcap, $ngaykk, $kk);
                }
            }
        }
        Session::flash('message',$loi);
    }
    public function process_Them($mats, $tents, $l, $ht, $u, $gia, $sl, $nam, $nangcap, $ngaykk, $kk){
        $Year = date('Y');
        DB::table('taisan_'.$Year)->insert(
            [
                'ts_MaTS' => $mats,
                'ts_TenTS' => $tents,
                'ts_SoLuong' => $sl,
                'ts_NguyenGia' => $gia,
                'ts_Nam' => $nam,
                'ts_NangCap' => $nangcap,
                'l_MaLoai' => $l,
                'ht_MaHT' => $ht,
                'cb_TenDangNhap' => $u,
                'ts_NgayKiemKe' => $ngaykk,
                'ts_KiemKe' => $kk,
                'ts_HieuLuc' => 0
            ]);
    }
}
