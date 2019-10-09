@extends('backend.layouts.index')
@section('title')
Loại Tài Sản
@endsection
@section('title-header')
DANH SÁCH LOẠI TÀI SẢN
@endsection
@section('main-content')
<p class="action" align="right">
	<a id="modal" class="btn btn-blue">Thêm</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="30%">Tên Loại</th>
			<th class="text-center" width="30%">Ghi Chú</th>
			<th class="text-center" width="30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachloai as $stt => $loai)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$loai->l_TenLoai}}</td>
			<td class="text-center">{{$loai->l_GhiChu}}</td>
			<td class="text-center">
				<button data-id="{{$loai->l_MaLoai}}" class="btn btn-blue btn-icon getSua">Sửa<i class="entypo-pencil"></i></button>
				<button data-id="{{$loai->l_MaLoai}}" class="btn btn-red btn-icon btnXoa">Xóa<i class="entypo-cancel"></i></button>
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
				<h4 class="modal-title">Thêm Mới Loại Tài Sản</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label for="l_TenLoai" class="control-label">Tên Loại</label>

							<input type="text" class="form-control" id="l_TenLoai" name="l_TenLoai" placeholder="Nhập Tên Loại">
						</div>	

					</div>

					<div class="col-md-6">

						<div class="form-group">
							<label for="l_GhiChu" class="control-label">Ghi Chú</label>

							<input type="text" class="form-control" id="l_GhiChu" name="l_GhiChu" placeholder="Nhập Ghi Chú">
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
				<h4 class="modal-title">Cập Nhật Loại Tài Sản</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label for="l_TenLoai" class="control-label">Tên Loại</label>
							<input type="text" class="form-control" id="l_TenLoai-edit" name="l_TenLoai" placeholder="Nhập Tên Loại">
						</div>	

					</div>

					<div class="col-md-6">

						<div class="form-group">
							<label for="l_GhiChu" class="control-label">Ghi Chú</label>

							<input type="text" class="form-control" id="l_GhiChu-edit" name="l_GhiChu" placeholder="Nhập Ghi Chú">
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
			if($('#l_TenLoai').val() != ""){
				$.ajax({
					type: 'POST',
					url: '{{route('loai.store')}}',
					data: {
						'l_TenLoai': $('#l_TenLoai').val(),
						'l_GhiChu': $('#l_GhiChu').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							$('#Them').modal('hide');
							swal({
								title: "Thành Công",
								text: "Loại Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('loai.index')}}';
							});
						}else if(data == 0){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Loại Đã Tồn Tại!",
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
			var URL = "{{ route('loai.edit',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					Key = data[0]['l_MaLoai'];
					$('#l_TenLoai-edit').val(data[0]['l_TenLoai']);
					$('#l_GhiChu-edit').val(data[0]['l_GhiChu']);
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
			if($('#l_TenLoai-edit').val() != ""){
				var ID = Key;
				URL = '{{ route('loai.update',":id") }}';
				URL = URL.replace(':id', ID);
				$.ajax({
					type: 'POST',
					url: URL,
					data: {
						'l_TenLoai': $('#l_TenLoai-edit').val(),
						'l_GhiChu': $('#l_GhiChu-edit').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							$('#Sua').modal('hide');
							swal({
								title: "Thành Công",
								text: "Loại Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('loai.index')}}';
							});
						}else if(data == 0){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Loại Đã Tồn Tại!",
								icon: "error",
							});
						}else if(data == 2){
							$('#Sua').modal('hide');
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
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('loai.destroy',":id") }}";
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
									text: "Kiểm Tra Các Tài Sản Có Loại Này!",
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