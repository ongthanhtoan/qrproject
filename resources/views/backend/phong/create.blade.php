@extends('backend.layouts.index')
@section('title')
PHÒNG - Thêm Mới
@endsection
@section('main-content')
@section('custom-css')
<style>
	.error{
		color: red;
	}
</style>
@endsection
<div ng-app="PhongApp">
	<div class="ibox bg-boxshadow">
		<div class="container" ng-controller="PhongController">
			<h1 class="text-center">THÊM MỚI PHÒNG</h1>
			<form method="post" ng-submit="submitForm()" name="frmPhong" id="frmPhong" novalidate>
				<div class="form-group">
					<div class="input-field col-12">
						<input id="txtTenPhong" name="txtTenPhong" ng-model="txtTenPhong" type="text" class="validate" required="true">
						<label for="txtTenPhong" class="">Tên Phòng</label>
						<p class="error" ng-show="submitted && frmPhong.txtTenPhong.$error.required">Không Được Bỏ Trống</p>
					</div>
				</div>
				<div class="text-center">
					<button ng-click="submitted=true" type="submit" id="btnThem" class="btn waves-effect m-2 btn-success">THÊM</button>
					<a href="{{route('phong.index')}}" class="btn waves-effect m-2 btn-info">BỎ QUA</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	var app = angular.module('PhongApp',[]);
	app.controller('PhongController', function($scope){
		$scope.submitForm = function(){
			if($scope.frmPhong.$valid){
				$.ajax({
					type: 'POST',
					url: '{{route('phong.store')}}',
					data: {
						'txtTenPhong': $('#txtTenPhong').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							swal({
								title: "Thành Công",
								text: "Phòng Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('phong.index')}}';
							});
						}else if(data == 0){
							swal({
								title: "Thất Bại",
								text: "Phòng Đã Tồn Tại!",
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