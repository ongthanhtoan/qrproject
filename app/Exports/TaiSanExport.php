<?php

namespace App\Exports;

use App\HienTrang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;
class TaiSanExport implements FromView, WithEvents, ShouldAutoSize
{	
	public function view(): View
	{
		$Year = date('Y');
		$data = DB::table('taisan_'.$Year)
		->select('taisan_'.$Year.'.ts_MaTS','ts_TenTS','ts_SoLuong','ts_NguyenGia','ts_Nam','ts_NgayKiemKe','ts_NangCap','l_TenLoai','ht_TenHT','ts_KiemKe', 'bg_NguoiNhan', 'cb_HoTen', 'donvi.dv_TenDV', 'phong.p_TenPhong')
		->leftjoin('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
		->leftjoin('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
		->leftjoin('bangiao', 'taisan_'.$Year.'.ts_MaTS','=','bangiao.ts_MaTS')
		->leftjoin('canbo', 'bangiao.bg_NguoiNhan','=','canbo.cb_TenDangNhap')
		->leftjoin('donvi', 'bangiao.dv_MaDV', '=', 'donvi.dv_MaDV')
		->leftjoin('phong', 'bangiao.p_MaPhong', '=', 'phong.p_MaPhong')
		->get();
		$HienTrang = HienTrang::all();
		return view('backend.taisan.export')->with('data',$data)->with('dsHienTrang',$HienTrang);
	}

    /**
 * @return array
 */
    public function registerEvents(): array
    {
    	return [
    		AfterSheet::class    => function(AfterSheet $event) {
    			$Count = 0;
    			$Year = date('Y');
    			$data = DB::table('taisan_'.$Year)
    			->select('taisan_'.$Year.'.ts_MaTS','ts_TenTS','ts_SoLuong','ts_NguyenGia','ts_Nam','ts_NgayKiemKe','ts_NangCap','l_TenLoai','ht_TenHT','ts_KiemKe', 'bg_NguoiNhan', 'cb_HoTen', 'donvi.dv_TenDV', 'phong.p_TenPhong')
    			->leftjoin('loai','taisan_'.$Year.'.l_MaLoai','=','loai.l_MaLoai')
    			->leftjoin('hientrang','taisan_'.$Year.'.ht_MaHT','=','hientrang.ht_MaHT')
    			->leftjoin('bangiao', 'taisan_'.$Year.'.ts_MaTS','=','bangiao.ts_MaTS')
    			->leftjoin('canbo', 'bangiao.bg_NguoiNhan','=','canbo.cb_TenDangNhap')
    			->leftjoin('donvi', 'bangiao.dv_MaDV', '=', 'donvi.dv_MaDV')
    			->leftjoin('phong', 'bangiao.p_MaPhong', '=', 'phong.p_MaPhong')
    			->get();
    			$Count = count($data)+2;
    			$Count2 = count($data);
    			$cellRange = 'A1:S'.$Count; 
    			$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
    			$styleArray = [
    				'borders' => [
    					'allBorders' => [
    						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    						'color' => ['argb' => '000000']
    					]
    				],
    				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
    			];
    			$styleArray2 = [
    				'font' => [
    					'bold' => true,
    				]
    			];
    			$event->sheet->getDelegate()->getStyle('A1:S'.$Count)->applyFromArray($styleArray);
    			$event->sheet->getStyle('A1:S2')->applyFromArray($styleArray2);

    			$event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

    			$event->sheet->getStyle('A1:S'.$Count)->getAlignment()->setHorizontal('center');
    			$event->sheet->getStyle('A1:S2')->getAlignment()->applyFromArray(['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER] );
    		},
    	];
    }
}
