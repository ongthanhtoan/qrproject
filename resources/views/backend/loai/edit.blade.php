@extends('backend.layouts.index')
@section('title')
Loại Tài Sản - Cập Nhật
@endsection
@section('main-content')
@section('custom-css')
<style>
.error{
	color: red;
}
</style>
@endsection
<div ng-app="LoaiApp">
	<div class="ibox bg-boxshadow">
		<div class="container" ng-controller="LoaiController">
			<h1 class="text-center">CẬP NHẬT LOẠI TÀI SẢN</h1>
			<form method="post" ng-submit="submitForm()" name="frmLoai" id="frmLoai" novalidate>
				<div class="form-group">
					<div class="input-field col-12">
						<input id="txtTenLoai" name="txtTenLoai" type="text" class="validate" required="true" value="{{$loai->l_TenLoai}}">
						<label for="txtTenLoai" class="">Tên Loại</label>
					</div>
				</div>
				<div class="form-group">
					<div class="input-field col-12">
						<input id="txtGhiChu" name="txtGhiChu" type="text" class="validate" value="{{$loai->l_GhiChu}}">
						<label for="txtGhiChu" class="">Ghi Chú</label>
					</div>
				</div>
				<div class="text-center">
					<button ng-click="submitted=true" type="submit" id="btnThem" class="btn waves-effect m-2 btn-success">CẬP NHẬT</button>
					<a href="{{route('loai.index')}}" class="btn waves-effect m-2 btn-info">BỎ QUA</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	var app = angular.module('LoaiApp',[]);
	app.controller('LoaiController', function($scope){
		$scope.submitForm = function(){
			if($scope.frmLoai.$valid){
				$.ajax({
					type: 'POST',
					url: '{{route('loai.update',['id'=>$loai->l_MaLoai])}}',
					data: {
						'txtTenLoai': $('#txtTenLoai').val(),
						'txtGhiChu': $('#txtGhiChu').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							swal({
								title: "Thành Công",
								text: "Loại Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('loai.index')}}';
							});
						}else if(data == 0){
							swal({
								title: "Thất Bại",
								text: "Loại Đã Tồn Tại!",
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
			}
		};
	});
</script>
@endsection