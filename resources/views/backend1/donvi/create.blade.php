@extends('backend.layouts.index')
@section('title')
Đơn Vị - Thêm Mới
@endsection
@section('main-content')
@section('custom-css')
<style>
.error{
	color: red;
}
</style>
@endsection
<div ng-app="DonViApp">
	<div class="ibox bg-boxshadow">
		<div class="container" ng-controller="DonViController">
			<h1 class="text-center">THÊM MỚI ĐƠN Vị</h1>
			<form method="post" ng-submit="submitForm()" name="frmDonVi" id="frmDonVi" novalidate>
				<div class="form-group">
					<div class="input-field col-12">
						<input id="txtTenDV" name="txtTenDV" ng-model="txtTenDV" type="text" class="validate" required="true">
						<label for="txtTenDV" class="">Tên Đơn Vị</label>
						<p class="error" ng-show="submitted && frmDonVi.txtTenDV.$error.required">Không Được Bỏ Trống</p>
					</div>
				</div>
				<div class="text-center">
					<button ng-click="submitted=true" type="submit" id="btnThem" class="btn waves-effect m-2 btn-success">THÊM</button>
					<a href="{{route('don-vi.index')}}" class="btn waves-effect m-2 btn-info">BỎ QUA</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	var app = angular.module('DonViApp',[]);
	app.controller('DonViController', function($scope){
		$scope.submitForm = function(){
			if($scope.frmDonVi.$valid){
				$.ajax({
					type: 'POST',
					url: '{{route('don-vi.store')}}',
					data: {
						'txtTenDV': $('#txtTenDV').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							swal({
								title: "Thành Công",
								text: "Đơn vị Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('don-vi.index')}}';
							});
						}else if(data == 0){
							swal({
								title: "Thất Bại",
								text: "Đơn Vị Đã Tồn Tại!",
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