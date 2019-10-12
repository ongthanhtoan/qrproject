@extends('backend.layouts.index')
@section('title')
Phòng
@endsection
@section('title-header')
DANH SÁCH PHÒNG BAN
@endsection
@section('main-content')
<p class="action" align="right">
	<a id="modal" class="btn btn-blue">Thêm mói</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="30%">Tên Phòng</th>
			<th class="text-center" width="30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachphong as $stt => $Phong)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$Phong->p_TenPhong}}</td>
			<td class="text-center">
				<button data-id="{{$Phong->p_MaPhong}}" class="btn btn-blue btn-icon getSua">Sửa<i class="entypo-pencil"></i></button>
				<button data-id="{{$Phong->p_MaPhong}}" class="btn btn-red btn-icon btnXoa">Xóa<i class="entypo-cancel"></i></button>
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
				<h4 class="modal-title">Thêm Mới Phòng</h4>
			</div>

			<div class="modal-body">
				<p class="error" style="color:red;"></p>
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="p_TenPhong" class="control-label">Tên Phòng</label>

							<input type="text" class="form-control" id="p_TenPhong" name="p_TenPhong" placeholder="Nhập Tên Phòng">
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
				<h4 class="modal-title">Cập Nhật Phòng</h4>
			</div>

			<div class="modal-body">
				<p class="error" style="color:red;"></p>
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="p_TenPhong-edit" class="control-label">Tên Phòng</label>
							<input type="text" class="form-control" id="p_TenPhong-edit" name="p_TenPhong-edit" placeholder="Nhập Tên Phòng">
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
                    $(".error").html('');
                    $('#Them').modal().show();
		});
		$('#btnThem').click(function(){
			if($('#p_TenPhong').val() != ""){
				$.ajax({
					type: 'POST',
					url: '{{route('phong.store')}}',
					data: {
						'p_TenPhong': $('#p_TenPhong').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							$('#Them').modal('hide');
							swal({
								title: "Thành Công",
								text: "Phong Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('phong.index')}}';
							});
						}else if(data == 0){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Phòng Đã Tồn Tại!",
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
			}else{
                            $(".error").html('Vui lòng nhập tên Phòng');
                        }
		});
		$('.getSua').click(function(){
			var ID = $(this).data('id');
			var URL = "{{ route('phong.edit',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					Key = data[0]['p_MaPhong'];
					$('#p_TenPhong-edit').val(data[0]['p_TenPhong']);
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
                        $(".error").html('');
			$('#Sua').modal().show();
		});
		$('#btnSua').click(function(){
			if($('#p_TenPhong-edit').val() != ""){
				var ID = Key;
				URL = '{{ route('phong.update',":id") }}';
				URL = URL.replace(':id', ID);
				$.ajax({
					type: 'POST',
					url: URL,
					data: {
						'p_TenPhong': $('#p_TenPhong-edit').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							$('#Sua').modal('hide');
							swal({
								title: "Thành Công",
								text: "Phòng Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('phong.index')}}';
							});
						}else if(data == 0){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Phòng Đã Tồn Tại!",
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
			}else{
                            $(".error").html('Vui lòng nhập tên Phòng');
                        }
		});
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('phong.destroy',":id") }}";
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
									text: "Kiểm Tra Các Phòng Có Loại Này!",
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