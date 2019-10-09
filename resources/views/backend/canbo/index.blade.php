@extends('backend.layouts.index')
@section('title')
Quản Trị
@endsection
@section('title-header')
DANH SÁCH CÁN BỘ
@endsection
@section('main-content')
<p class="action" align="right">
	<a id="modal" class="btn btn-blue">Thêm</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="20%">Tên đăng nhập</th>
			<th class="text-center" width="20%">Họ Tên</th>
			<th class="text-center" width="20%">Kiểm Kê</th>
			<th class="text-center" width="20%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachcanbo as $stt => $CanBo)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$CanBo->cb_TenDangNhap}}</td>
			<td class="text-center">{{$CanBo->cb_HoTen}}</td>
			<td class="text-center">{{$CanBo->cb_KiemKe}}</td>
			@if($CanBo->cb_KiemKe == 0)
			<td class="text-center">
				<button data-id="{{$CanBo->cb_TenDangNhap}}" class="btn btn-success btnCapQuyen">Cấp Quyền</button>
				<button data-id="{{$CanBo->cb_TenDangNhap}}" class="btn btn-danger btnXoa">Xóa</button>
			</td>
			@else
			<td class="text-center">
				<button data-id="{{$CanBo->cb_TenDangNhap}}" class="btn btn-danger btnHuyQuyen">Hủy Quyền</button>
				<button data-id="{{$CanBo->cb_TenDangNhap}}" class="btn btn-danger btnXoa">Xóa</button>
			</td>

			@endif
		</tr>
		@endforeach
	</tbody>
</table>
<!-- Modal Thêm-->
<div class="modal fade" id="Them">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thêm Cán Bộ</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="slAdmin" class="control-label">Chọn Cán Bộ Để Thêm</label>

							<select class="form-control" id="slAdmin"></select>
						</div>	

					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-info" id="btnThem">Thêm</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		$('.btnCapQuyen').click(function(){
			var ID = $(this).data('id');
			var URL = "{{ route('cap-quyen.capQuyen',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					if(data == 1){
						swal({
							title: "Thành Công!",
							icon: "success",
							button: "OK!",
						}).then(function() {
							location.reload();
						});
					}else if(data == 2){
						swal({
							title: "Thất Bại!",
							text: "Liên Hệ Quản Trị Website!",
							icon: "error",
							button: "OK!",
						});
					}
				},
				error: function(){
					swal({
						title: "Thất Bại!",
						text: "Thử Lại Sau!",
						icon: "error",
						button: "OK!",
					});
				}
			});
		});
		$('.btnHuyQuyen').click(function(){
			var ID = $(this).data('id');
			var URL = "{{ route('cap-quyen.huyQuyen',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					if(data == 1){
						swal({
							title: "Thành Công!",
							icon: "success",
							button: "OK!",
						}).then(function() {
							location.reload();
						});
					}else if(data == 2){
						swal({
							title: "Thất Bại!",
							text: "Liên Hệ Quản Trị Website!",
							icon: "error",
							button: "OK!",
						});
					}
				},
				error: function(){
					swal({
						title: "Thất Bại!",
						text: "Thử Lại Sau!",
						icon: "error",
						button: "OK!",
					});
				}
			});
		});
		$('#modal').click(function(){
			$('#Them').modal('show');
			$("#slAdmin").empty();
			$.ajax({
				type: "GET",
				url: '{{route('can-bo.create')}}',
				success: function(datas){
					var options = '';
					$.each(datas, function(key, value) {
						options += '<option value='+value.username+'>'+value.HoTen+'</option>';
					});
					$('#slAdmin').append(options);
				}
			});
		});
		$('#btnThem').click(function(){
			$.ajax({
				type: "POST",
				url: '{{route('can-bo.store')}}',
				data: {
					'slAdmin': $('#slAdmin').val(),
					'_token': '{{csrf_token()}}'
				},
				success: function(data){
					if(data == 1){
						$('#Them').modal('hide');
						swal({
							title: "Thành Công!",
							icon: "success",
							button: "OK!",
						}).then(function() {
							location.reload();
						});
					}else if(data == 2){
						$('#Them').modal('hide');
						swal({
							title: "Thất Bại!",
							text: "Cán Bộ Này Đã Tồn Tại!",
							icon: "error",
							button: "OK!",
						});
					}
				},
				error: function(){
					$('#Them').modal('hide');
					swal({
						title: "Thất Bại!",
						text: "Cán Bộ Này Đã Tồn Tại!",
						icon: "error",
						button: "OK!",
					});
				}
			});
		});
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('can-bo.destroy',":id") }}";
			URL = URL.replace(':id', ID);
			event.preventDefault();
			swal({
				title: "Xác Nhận Xóa?",
				text: "Nhấn OK Để Xóa, Cancel Để Hủy!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: "POST",
						url: URL,
						data: {
							'_token': '{{ csrf_token() }}',
							'_method': "DELETE"
						},
						success: function(data){
							if(data == 1){
								swal({
									title: "Xóa Thành Công!",
									icon: "success",
									button: "OK!",
								}).then(function() {
									location.reload();
								});
							}else if(data == 2){
								swal({
									title: "Thất Bại!",
									text: "Cán Bộ Này Đang Được Sử Dụng!",
									icon: "error",
									button: "OK!",
								});
							}
						},
						error: function(){
							swal({
								title: "Thất Bại!",
								text: "Thử Lại Sau!",
								icon: "error",
								button: "OK!",
							});
						}
					});
				} else {
					swal("Đã Hủy!", {
						icon: "info",
					});
				}
			});
		});
	});
</script>
@endsection