@extends('backend.layouts.index')
@section('title')
Hiện Trạng - Cập Nhật
@endsection
@section('main-content')
@section('custom-css')
<style>
	.error{
		color: red;
	}
</style>
@endsection
<div ng-app="HienTrangApp">
	<div class="ibox bg-boxshadow">
		<div class="container" ng-controller="HienTrangController">
			<h1 class="text-center">CẬP NHẬT HIỆN TRẠNG</h1>
			<form method="post" ng-submit="submitForm()" name="frmHienTrang" id="frmHienTrang" novalidate>
				<div class="form-group">
					<div class="input-field col-12">
						<input id="txtTenHT" name="txtTenHT" type="text" class="validate" required="true" value="{{$hientrang->ht_TenHT}}">
						<label for="txtTenHT" class="">Tên Hiện Trạng</label>
						<p class="error" ng-show="submitted && frmHienTrang.txtTenHT.$error.required">Không Được Bỏ Trống</p>
					</div>
				</div>
				<div class="text-center">
					<button ng-click="submitted=true" type="submit" id="btnThem" class="btn waves-effect m-2 btn-success">CẬP NHẬT</button>
					<a href="{{route('hien-trang.index')}}" class="btn waves-effect m-2 btn-info">BỎ QUA</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	var app = angular.module('HienTrangApp',[]);
	app.controller('HienTrangController', function($scope){
		$scope.submitForm = function(){
			if($scope.frmHienTrang.$valid){
				$.ajax({
					type: 'POST',
					url: '{{route('hien-trang.update',['id'=>$hientrang->ht_MaHT])}}',
					data: {
						'txtTenHT': $('#txtTenHT').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							swal({
								title: "Thành Công",
								text: "Hiện Trạng Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('hien-trang.index')}}';
							});
						}else if(data == 0){
							swal({
								title: "Thất Bại",
								text: "Hiện Trạng Đã Tồn Tại!",
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