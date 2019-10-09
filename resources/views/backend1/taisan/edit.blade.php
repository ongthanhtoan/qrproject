@extends('backend.layouts.index')
@section('title')
Tài Sản - Cập Nhật
@endsection
@section('title-header')
CẬP NHẬT TÀI SẢN
@endsection
@section('main-content')
@section('custom-css')
<style>
	.error{
		color: red;
	}
	.form-control{
		visibility: visible;
	}
</style>
@endsection
<form class="validate" autocomplete="off">
	<div class="row">

		<div class="col-md-6">

			<div class="form-group">
				<label for="ts_TenTS" class="control-label">Tên Tài Sản</label>

				<input type="text" class="form-control" id="ts_TenTS" name="ts_TenTS" placeholder="Nhập Tên Tài Sản" value="{{$taisan->ts_TenTS}}">
			</div>	

		</div>

		<div class="col-md-6">

			<div class="form-group">
				<label class="control-label">Số Lượng</label>

				<input type="text" class="form-control" id="ts_SoLuong" name="ts_SoLuong" data-validate="number" placeholder="Nhập Số Lượng" aria-invalid="false" aria-describedby="number-error" value="{{$taisan->ts_SoLuong}}"><span id="number-error" class="validate-has-error" style="display: none;"></span>
			</div>	

		</div>

		<div class="col-md-6">

			<div class="form-group">
				<label class="control-label">Nguyên Giá</label>

				<input type="text" class="form-control" id="ts_NguyenGia" name="ts_NguyenGia" data-validate="number" placeholder="Nhập Số Lượng" aria-invalid="false" aria-describedby="number-error" value="{{$taisan->ts_NguyenGia}}"><span id="number-error" class="validate-has-error" style="display: none;"></span>
			</div>	

		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Năm Mua</label>

				<div>
					<input id="ts_Nam" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Năm Mua Tài Sản" value="{{$taisan->ts_Nam}}">
				</div>
			</div>	
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Loại Tài Sản</label>
				<div>
					<select id="slLoai" class="form-control">
						<option value="0">Chọn Loại Tài Sản</option>
						@foreach($dsLoai as $Loai)
						<option class="form-group" {{$Loai->l_MaLoai==$taisan->l_MaLoai?"selected":""}} value="{{$Loai->l_MaLoai}}">{{$Loai->l_TenLoai}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Hiện Trạng</label>
				<div>
					<select id="slHienTrang" class="form-control">
						<option value="0">Chọn Hiện Trạng</option>
						@foreach($dsHienTrang as $HienTrang)
						<option class="form-group" {{$HienTrang->ht_MaHT==$taisan->ht_MaHT?"selected":""}} value="{{$HienTrang->ht_MaHT}}">{{$HienTrang->ht_TenHT}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Nâng Cấp</label>

				<input type="text" class="form-control" id="ts_NangCap" name="ts_NangCap" placeholder="Nhập Thông Tin Nâng Cấp" value="{{$taisan->ts_NangCap}}">
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Người Kiểm Kê</label>
				<div>
					<select id="slCanBo" class="form-control">
						<option value="0">Chọn Người Kiểm Kê</option>
						@foreach($dsCanBo as $CanBo)
						<option class="form-group" {{$taisan->cb_TenDangNhap == $CanBo->cb_TenDangNhap ? "selected" : ""}} value="{{$CanBo->cb_TenDangNhap}}">{{$CanBo->cb_HoTen}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Ngày Kiểm Kê</label>

				<div>
					<input id="ts_NgayKiemKe" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Ngày Kiểm Kê" value="{{$taisan->ts_NgayKiemKe}}">
				</div>
			</div>	
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Kiểm Kê Tài Sản</label>
				<div>
					<select id="slKiemKe" class="form-control">
						<option {{$taisan->ts_KiemKe==0?"selected":""}} value="0">Chưa Kiểm Kê</option>
						<option {{$taisan->ts_KiemKe==1?"selected":""}} value="1">Đã Kiểm Kê</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		<a href="{{route('tai-san.index')}}" class="btn btn-danger">Đóng</a>
		<button type="button" class="btn btn-info" id="btnSua">Cập Nhật</button>
	</div>
</form>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		$('#btnSua').click(function(){
			$.ajax({
				type: 'POST',
				url: '{{route('tai-san.update',['id'=>$taisan->ts_MaTS])}}',
				data: {
					'ts_TenTS': $('#ts_TenTS').val(),
					'ts_SoLuong': $('#ts_SoLuong').val(),
					'ts_NguyenGia': $('#ts_NguyenGia').val(),
					'ts_Nam': $('#ts_Nam').val(),
					'slCanBo': $('#slCanBo').val(),
					'ts_NgayKiemKe': $('#ts_NgayKiemKe').val(),
					'ts_NangCap': $('#ts_NangCap').val(),
					'slLoai': $('#slLoai').val(),
					'slHienTrang': $('#slHienTrang').val(),
					'slKiemKe': $('#slKiemKe').val(),
					'_token': '{{csrf_token()}}',
					'_method': 'PUT'
				},
				success: function(data){
					if(data == 1){
						swal({
							title: "Thành Công",
							text: "Tài Sản Đã Được Cập Nhật!",
							icon: "success",
						}).then(function(){
							location.href = '{{route('tai-san.index')}}';
						});
					}else if(data == 0){
						swal({
							title: "Thất Bại",
							text: "Tài Sản Đã Tồn Tại!",
							icon: "error",
						});
					}else if(data == 2){
						swal({
							title: "Thất Bại",
							text: "Lỗi Thử Lại Sau, Hoặc Liên Hệ Với Quản Trị Web!",
							icon: "error",
						});
					}
				}
			});
		});
	});
</script>
@endsection