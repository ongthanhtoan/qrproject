@extends('backend.layouts.index')
@section('title')
Hiện Trạng
@endsection
@section('main-content')
<h1 class="text-center">DANH SÁCH HIỆN TRẠNG</h1>
<p class="action">
	<a id="modal" class="btn btn-blue">Thêm</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="30%">Tên Hiện Trạng</th>
			<th class="text-center" width="30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachhientrang as $stt => $HienTrang)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$HienTrang->ht_TenHT}}</td>
			<td class="text-center">
				<button data-id="{{$HienTrang->ht_MaHT}}" class="btn btn-blue btn-icon getSua">Sửa<i class="entypo-pencil"></i></button>
				<button data-id="{{$HienTrang->ht_MaHT}}" class="btn btn-red btn-icon btnXoa">Xóa<i class="entypo-cancel"></i></button>
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
				<h4 class="modal-title">Thêm Mới Hiện Trạng</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="ht_TenHT" class="control-label">Tên Hiện Trạng</label>

							<input type="text" class="form-control" id="ht_TenHT" name="ht_TenHT" placeholder="Nhập Tên Hiện Trạng">
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
				<h4 class="modal-title">Cập Nhật Hiện Trạng</h4>
			</div>

			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="ht_TenHT-edit" class="control-label">Tên Hiện Trạng</label>

							<input type="text" class="form-control" id="ht_TenHT-edit" name="ht_TenHT-edit" placeholder="Nhập Tên Hiện Trạng">
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
			$('#Them').modal('show');
		});
		$('#btnThem').click(function(){
			if($('#ht_TenHT').val() != ""){
				$.ajax({
					type: 'POST',
					url: '{{route('hien-trang.store')}}',
					data: {
						'ht_TenHT': $('#ht_TenHT').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							$('#Them').modal('hide');
							swal({
								title: "Thành Công",
								text: "Hiện Trạng Đã Được Thêm Mới!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('hien-trang.index')}}';
							});
						}else if(data == 0){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Hiện Trạng Đã Tồn Tại!",
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
			var URL = "{{ route('hien-trang.edit',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					Key = data[0]['ht_MaHT'];
					$('#ht_TenHT-edit').val(data[0]['ht_TenHT']);
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
			$('#Sua').modal('show');
		});
		$('#btnSua').click(function(){
			if($('#l_TenLoai-edit').val() != ""){
				var ID = Key;
				URL = '{{ route('hien-trang.update',":id") }}';
				URL = URL.replace(':id', ID);
				$.ajax({
					type: 'POST',
					url: URL,
					data: {
						'ht_TenHT': $('#ht_TenHT-edit').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							$('#Sua').modal('hide');
							swal({
								title: "Thành Công",
								text: "Hiện Trạng Đã Được Cập Nhật!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('hien-trang.index')}}';
							});
						}else if(data == 0){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Hiện Trạng Đã Tồn Tại!",
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
			var URL = "{{ route('hien-trang.destroy',":id") }}";
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
									text: "Kiểm Tra Các Hiện Trạng Có Loại Này!",
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