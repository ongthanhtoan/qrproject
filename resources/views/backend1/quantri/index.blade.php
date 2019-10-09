@extends('backend.layouts.index')
@section('title')
Quản Trị
@endsection
@section('main-content')
<h1 class="text-center">DANH SÁCH QUẢN TRỊ</h1>
<p class="action">
	<a id="modal" class="btn btn-blue">Thêm</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="30%">Họ Tên</th>
			<th class="text-center" width="30%">Tên Đăng Nhập</th>
			<th class="text-center" width="30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachuser as $stt => $Users)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$Users->HoTen}}</td>
			<td class="text-center">{{$Users->username}}</td>
			<td class="text-center">
				<button data-id="{{$Users->username}}" class="btn btn-blue btn-icon getSua">Sửa<i class="entypo-pencil"></i></button>
				<button data-id="{{$Users->username}}" class="btn btn-red btn-icon btnXoa">Xóa<i class="entypo-cancel"></i></button>
			</td>
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
				<h4 class="modal-title">Thêm Mới Quản Trị</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="qt_HoTen" class="control-label">Họ Tên</label>

							<input type="text" class="form-control" id="qt_HoTen" name="qt_HoTen" placeholder="Nhập Tên Quản Trị">
						</div>	
						<div class="form-group">
							<label for="qt_TenDangNhap" class="control-label">Tên Đăng Nhập</label>
							<input type="text" class="form-control" id="qt_TenDangNhap" name="qt_TenDangNhap" placeholder="Nhập Tên Đăng Nhập">
						</div>	
						<div class="form-group">
							<label for="qt_MatKhau" class="control-label">Mật Khẩu</label>
							<input type="password" class="form-control" id="qt_MatKhau" name="qt_MatKhau">
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
<!-- Modal Sửa-->
<div class="modal fade" id="Sua">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cập Nhật Quản Trị</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="qt_HoTen-edit" class="control-label">Họ Tên</label>
							<input type="text" class="form-control" id="qt_HoTen-edit" name="qt_HoTen-edit" >
						</div>	
						<div class="form-group">
							<label for="qt_TenDangNhap-edit" class="control-label">Tên Đăng Nhập</label>
							<input type="text" class="form-control" id="qt_TenDangNhap-edit" name="qt_TenDangNhap-edit" >
						</div>
						<div class="form-group">
							<label for="qt_MatKhauMoi-edit" class="control-label">Mật Khẩu Cũ</label>
							<input type="password" class="form-control" id="qt_MatKhauCu-edit" name="qt_MatKhauCu-edit" >
						</div>	
						<div class="form-group">
							<label for="qt_MatKhauMoi-edit" class="control-label">Mật Khẩu Mới</label>
							<input type="password" class="form-control" id="qt_MatKhauMoi-edit" name="qt_MatKhauMoi-edit" >
						</div>	
					</div>
					
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-info" id="btnSua">Cập Nhật</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		var Key;
		$('#modal').click(function(){
			$('#Them').modal().show();
		});
		$('#btnThem').click(function(){
			if($('#qt_HoTen').val() != ""){
				$.ajax({
					type: 'POST',
					url: '{{route('users.store')}}',
					data: {
						'HoTen': $('#qt_HoTen').val(),
						'username': $('#qt_TenDangNhap').val(),
						'password': $('#qt_MatKhau').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							$('#Them').modal('hide');
							swal({
								title: "Thành Công",
								text: "Quản Trị Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('users.index')}}';
							});
						}else if(data == 0){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Quản Trị Đã Tồn Tại!",
								icon: "error",
							});
						}else if(data == 2){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Lỗi Thử Lại Sau, Hoặc Liên Hệ Với Quản Trị Web!",
								icon: "error",
							});
						}
					}
				});
			}
		});
		$('.getSua').click(function(){
			var ID = $(this).data('id');
			var URL = "{{ route('users.edit',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				dataType:"json",
				url: URL,
				success: function(data){
					// console.log(data[0][0]);
					Key = data[0][0]['username'];
					$('#qt_HoTen-edit').val(data[0][0]['HoTen']);
					$('#qt_TenDangNhap-edit').val(data[0][0]['username']);
				},
				error: function(){
					swal({
						title: "Thất Bại!",
						text: "Không Thể Sửa Vào Lúc Này",
						icon: "error",
						button: "OK!",
					});
				}
			});
			$('#Sua').modal().show();
		});
		$('#btnSua').click(function(){
			if($('#qt_HoTen-edit').val() != null && $('#qt_TenDangNhap-edit').val() != null){
				var ID = Key;
				URL = '{{ route('users.update',":id") }}';
				URL = URL.replace(':id', ID);
				$.ajax({
					type: 'POST',
					url: URL,
					data: {
						'HoTen': $('#qt_HoTen-edit').val(),
						'username': $('#qt_TenDangNhap-edit').val(),
						'password': $('#qt_MatKhauCu-edit').val(),
						'passwordnew': $('#qt_MatKhauMoi-edit').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							$('#Sua').modal('hide');
							swal({
								title: "Thành Công",
								text: " Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('users.index')}}';
							});
						}else if(data == 0){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Tên Đăng Nhập Đã Tồn Tại!",
								icon: "error",
							});
						}else if(data == 2){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Sai Mật Khẩu",
								icon: "error",
							});
						}
						
					}
				});
			}
		});
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('users.destroy',":id") }}";
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
									text: "Hãy Kiểm Tra Các Quản Trị Có Loại Này!",
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