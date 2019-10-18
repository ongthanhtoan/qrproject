
<table border="1">
	<thead>
	<caption><h3>BẢN KIỂM KÊ TÀI SẢN CỐ ĐỊNH</h3></caption>
		<tr>
			<th rowspan="2" align="center">TT</th>
			<th rowspan="2" align="center">Tên tài sản</th>
			<th rowspan="2" align="center">Loại tài sản</th>
			<th colspan="3" align="center">Theo sổ sách quản lý</th>
			<th rowspan="2" align="center">Số lượng kiểm kê theo thực thế</th>
			<th colspan="2" align="center">Chênh lệch số lượng</th>
			<th colspan="5" align="center">Hiện trạng tài sản cố định</th>
			<th rowspan="2" align="center">Ghi chú</th>
			<th rowspan="2" align="center">Nơi đặt</th>
			<th rowspan="2" align="center">Người quản lý/Sử dụng</th>
			<th rowspan="2" align="center">Năm</th>
			<th rowspan="2" align="center">Thay đổi cấu hình, nâng cấp tài sản</th>
			<th rowspan="2" align="center">Kiểm kê</th>
		</tr>
		<tr>
			<th align="center">Số mã vạch</th>
			<th align="center">Số lượng</th>
			<th align="center">Nguyên giá</th>
			<th align="center">Thừa</th>
			<th align="center">Thiếu</th>
			<th align="center">Đang sử dụng</th>
			<th align="center">Hư hỏng xin thanh lý</th>
			<th align="center">Hư hỏng chờ sửa chữa</th>
			<th align="center">Mất</th>
			<th align="center">Không nhu cầu sử dụng</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $key => $value)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$value->ts_TenTS}}</td>
			<td>{{$value->l_TenLoai}}</td>
			<td>{{$value->ts_MaTS}}</td>
			<td>{{$value->ts_SoLuong}}</td>
			<td>{{number_format($value->ts_NguyenGia)}}</td>
			<td></td>
			<td></td>
			<td></td>
			@foreach($dsHienTrang as $HienTrang)
			<td>{{$value->ht_TenHT == $HienTrang->ht_TenHT?"X":""}}</td>
			@endforeach
			<td></td>
			<td>{{$value->dv_TenDV." ".$value->p_TenPhong}}</td>
			<td>{{$value->cb_HoTen}}</td>
			<td>{{$value->ts_Nam}}</td>
			<td>{{$value->ts_NangCap}}</td>
			<td>{{$value->ts_KiemKe == 1?"X":""}}</td>
		</tr>
		@endforeach
	</tbody>
</table>