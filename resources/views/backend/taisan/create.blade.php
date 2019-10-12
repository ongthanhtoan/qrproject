@extends('backend.layouts.index')
@section('title')
Tài Sản - Thêm Mới
@endsection
@section('title-header')
THÊM MỚI TÀI SẢN
@endsection
@section('main-content')
@section('custom-css')
<style>
	.error{
		color: red;
	}
	.selectboxit{
		visibility: visible;
	}
</style>
@endsection
<form id="frmMain" onSubmit="return false;" class="validate" autocomplete="off">
	<div class="row">
		<div class="col-md-6">

			<div class="form-group">
				<label for="ts_MaTS" class="control-label">Mã Tài Sản</label>

				<input type="text" class="form-control" id="ts_MaTS" name="ts_MaTS" placeholder="Nhập Mã Tài Sản" data-validate="required" data-message-required="Vui lòng nhập mã tài sản">
			</div>	

		</div>

		<div class="col-md-6">

			<div class="form-group">
				<label for="ts_TenTS" class="control-label">Tên Tài Sản</label>

				<input type="text" class="form-control" id="ts_TenTS" name="ts_TenTS" placeholder="Nhập Tên Tài Sản" data-validate="required" data-message-required="Vui lòng nhập tên tài sản">
			</div>	

		</div>

		<div class="col-md-6">

			<div class="form-group">
				<label class="control-label">Số Lượng</label>

                                <input type="text" class="form-control" id="ts_SoLuong" name="ts_SoLuong" data-validate="number" placeholder="Nhập Số Lượng" aria-invalid="false" aria-describedby="number-error"><span id="number-error" class="validate-has-error" style="display: none;"></span>
			</div>	

		</div>

		<div class="col-md-6">

			<div class="form-group">
				<label class="control-label">Nguyên Giá</label>

				<input type="text" class="form-control" id="ts_NguyenGia" name="ts_NguyenGia" data-validate="number" placeholder="Nhập Số Lượng" aria-invalid="false" aria-describedby="number-error"><span id="number-error" class="validate-has-error" style="display: none;"></span>
			</div>	

		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Năm Mua</label>

				<div>
					<input id="ts_Nam" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Năm Mua Tài Sản" data-validate="required" data-message-required="Vui lòng chọn năm">
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
						<option class="form-group" value="{{$Loai->l_MaLoai}}">{{$Loai->l_MaLoai." - ".$Loai->l_TenLoai}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Nâng Cấp</label>

				<input type="text" class="form-control" id="ts_NangCap" name="ts_NangCap" placeholder="Nhập Thông Tin Nâng Cấp">
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Người Kiểm Kê</label>
				<div>
					<select id="slCanBo" class="form-control">
						<option value="0">Chọn Người Kiểm Kê</option>
						@foreach($dsCanBo as $CanBo)
						<option class="form-group" value="{{$CanBo->cb_TenDangNhap}}">{{$CanBo->cb_TenDangNhap." - ".$CanBo->cb_HoTen}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Ngày Kiểm Kê</label>

				<div>
					<input id="ts_NgayKiemKe" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Ngày Kiểm Kê">
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
						<option class="form-group" value="{{$HienTrang->ht_MaHT}}">{{$HienTrang->ht_MaHT." - ".$HienTrang->ht_TenHT}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Kiểm Kê Tài Sản</label>
				<div>
					<select id="slKiemKe" class="form-control">
						<option value="0">0 - Chưa Kiểm Kê</option>
						<option value="1">1 - Đã Kiểm Kê</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-info" id="btnThem">Thêm</button>
		<a href="{{route('tai-san.index')}}" class="btn btn-danger">Đóng</a>
	</div>
</form>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		$('#btnThem').click(function(){
                    var data =  $("#frmMain").serialize();
			if($("#ts_MaTS").val() != "" && $("#ts_TenTS").val() != "" && $("#ts_SoLuong").val() != "" 
                                && $("#ts_NguyenGia").val() != "" && $("#ts_Nam").val() != "" 
                                && $("#slCanBo").val() != 0 && $("#ts_NgayKiemKe").val() != "" 
                                && $("#slLoai").val() != 0 && $("#slHienTrang").val() != 0){
                            $.ajax({
				type: 'POST',
				url: '{{route('tai-san.store')}}',
				data: {
					'ts_MaTS': $('#ts_MaTS').val(),
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
					'_token': '{{csrf_token()}}'
				},
				success: function(data){
					if(data == 1){
						swal({
							title: "Thành Công",
							text: "Tài Sản Đã Được Thêm Mới!",
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
                        }else{
                            swal({
                                title: "Thất Bại",
                                text: "Vui lòng nhập đầy đủ thông tin!",
                                icon: "error",
                            });
                        }
		});
	});
</script>
@endsection