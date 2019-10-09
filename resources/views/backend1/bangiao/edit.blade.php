@extends('backend.layouts.index')
@section('title')
Bàn Giao - Tài Sản
@endsection
@section('title-header')
CẬP NHẬT TÀI SẢN BÀN GIAO
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
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
@endsection
<h1 class="text-center">CẬP NHẬT BÀN GIAO TÀI SẢN</h1>
<form class="validate" autocomplete="off">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Danh Sách Tài Sản</label>
				<div>
					<select id="slTaiSan" class="form-control chosen">
						<option value="0">Chọn Tài Sản Để Bàn Giao</option>
						@foreach($dsTaiSan as $TaiSan)
						<option class="form-group" {{$BanGiao->ts_MaTS == $TaiSan->ts_MaTS ? "selected" : ""}} value="{{$TaiSan->ts_MaTS}}">{{$TaiSan->ts_TenTS}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Người Giao</label>
				<div>
					<select id="slNguoiGiao" class="form-control">
						<option value="0">Chọn Người Giao</option>
						@foreach($dsCanBo as $CanBo)
						<option class="form-group" {{$BanGiao->bg_NguoiGiao == $CanBo->cb_TenDangNhap ? "selected" : ""}} value="{{$CanBo->cb_TenDangNhap}}">{{$CanBo->cb_HoTen}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Ngày Giao</label>

				<div>
					<input id="bg_NgayGiao" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Ngày Giao" value="{{$BanGiao->bg_NgayGiao}}">
				</div>
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Người Nhận</label>
				<div>
					<select id="slNguoiNhan" class="form-control">
						<option value="0">Chọn Người Nhận</option>
						@foreach($dsCanBo as $CanBo)
						<option class="form-group" {{$BanGiao->bg_NguoiNhan == $CanBo->cb_TenDangNhap ? "selected" : ""}} value="{{$CanBo->cb_TenDangNhap}}">{{$CanBo->cb_HoTen}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Ngày Giao</label>

				<div>
					<input id="bg_NgayNhan" type="text" class="form-control datepicker" data-start-view="2" placeholder="Chọn Ngày Nhận" value="{{$BanGiao->bg_NgayNhan}}">
				</div>
			</div>	
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Đơn Vị</label>
				<div>
					<select id="slDonVi" class="form-control">
						<option value="0">Chọn Đơn Vị</option>
						@foreach($dsDonVi as $DonVi)
						<option class="form-group" {{$BanGiao->dv_MaDV == $DonVi->dv_MaDV ? "selected" : ""}} value="{{$DonVi->dv_MaDV}}">{{$DonVi->dv_TenDV}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Phòng</label>
				<div>
					<select id="slPhong" class="form-control">
						<option value="0">Chọn Phòng</option>
						@foreach($dsPhong as $Phong)
						<option class="form-group" {{$BanGiao->p_MaPhong == $Phong->p_MaPhong ? "selected" : ""}} value="{{$Phong->p_MaPhong}}">{{$Phong->p_TenPhong}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="text-center">
			<a href="{{route('ban-giao.index')}}" type="button" class="btn btn-danger">Đóng</a>
			<button type="button" class="btn btn-info" id="btnSua">Cập Nhật</button>
		</div>
	</div>
</form>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		$('#btnSua').click(function(){
			if($('#slTaiSan').val() != 0 && $('#slNguoiGiao').val() != 0 && $('#bg_NgayGiao').val() != null && $('#slNguoiNhan').val() != 0 && $('#bg_NgayNhan').val() != null && $('#slDonVi').val() != 0 && $('#slPhong').val() != 0){
				$.ajax({
					type: 'POST',
					url: '{{route('ban-giao.update',['id'=>$BanGiao->bg_MaBG])}}',
					data: {
						'slTaiSan': $('#slTaiSan').val(),
						'slNguoiGiao': $('#slNguoiGiao').val(),
						'bg_NgayGiao': $('#bg_NgayGiao').val(),
						'slNguoiNhan': $('#slNguoiNhan').val(),
						'bg_NgayNhan': $('#bg_NgayNhan').val(),
						'slDonVi': $('#slDonVi').val(),
						'slPhong': $('#slPhong').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							swal({
								title: "Thành Công",
								text: "Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('ban-giao.index')}}';
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
					text: "Kiểm Tra Lại Các Trường Cần Nhập!",
					icon: "error",
				});
			}
		});
	});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script type="text/javascript">
	$(".chosen").chosen();
</script>
@endsection
