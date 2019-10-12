@extends('backend.layouts.index')
@section('title')
Đơn Vị
@endsection
@section('title-header')
DANH SÁCH ĐƠN VỊ
@endsection
@section('main-content')
<p class="action" align="right">
	<a id="modal" class="btn btn-blue">Thêm mới</a>
</p>
<table class="table table-bordered responsive"> 
	<thead>
		<tr>
			<th class="text-center" width="10%">STT</th>
			<th class="text-center" width="30%">Tên Đơn vị</th>
			<th class="text-center" width="30%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachdonvi as $stt => $DonVi)
		<tr>
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$DonVi->dv_TenDV}}</td>
			<td class="text-center">
				<button data-id="{{$DonVi->dv_MaDV}}" class="btn btn-blue btn-icon getSua">Sửa<i class="entypo-pencil"></i></button>
				<button data-id="{{$DonVi->dv_MaDV}}" class="btn btn-red btn-icon btnXoa">Xóa<i class="entypo-cancel"></i></button>
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
				<h4 class="modal-title">Thêm Mới Đơn Vị</h4>
			</div>

			<div class="modal-body">
                            <p class="error" style="color:red;"></p>
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="dv_TenDV" class="control-label">Tên Đơn Vị</label>

							<input type="text" class="form-control" id="dv_TenDV" name="dv_TenDV" placeholder="Nhập Tên Đơn Vị">
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
				<h4 class="modal-title">Cập Nhật Đơn Vị</h4>
			</div>

			<div class="modal-body">
				<p class="error" style="color:red;"></p>
				<div class="row">
					<div class="col-md-12">

						<div class="form-group">
							<label for="dv_TenDV-edit" class="control-label">Tên Đơn vị</label>
							<input type="text" class="form-control" id="dv_TenDV-edit" name="dv_TenDV-edit" placeholder="Nhập Tên Đơn Vị">
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
			if($('#dv_TenDV').val() != ""){
				$.ajax({
					type: 'POST',
					url: '{{route('don-vi.store')}}',
					data: {
						'dv_TenDV': $('#dv_TenDV').val(),
						'_token': '{{csrf_token()}}'
					},
					success: function(data){
						if(data == 1){
							$('#Them').modal('hide');
							swal({
								title: "Thành Công",
								text: "Thêm mới thành công!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('don-vi.index')}}';
							});
						}else if(data == 0){
							$('#Them').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Đơn Vị Đã Tồn Tại!",
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
                            $(".error").html("Vui lòng nhập tên Đơn vị.")
                        }
		});
		$('.getSua').click(function(){
			var ID = $(this).data('id');
			var URL = "{{ route('don-vi.edit',":id") }}";
			URL = URL.replace(':id', ID);
			$.ajax({
				type: "GET",
				url: URL,
				success: function(data){
					Key = data[0]['dv_MaDV'];
					$('#dv_TenDV-edit').val(data[0]['dv_TenDV']);
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
			if($('#dv_TenDV-edit').val() != ""){
				var ID = Key;
				URL = '{{ route('don-vi.update',":id") }}';
				URL = URL.replace(':id', ID);
				$.ajax({
					type: 'POST',
					url: URL,
					data: {
						'dv_TenDV': $('#dv_TenDV-edit').val(),
						'_token': '{{csrf_token()}}',
						'_method': 'PUT'
					},
					success: function(data){
						if(data == 1){
							$('#Sua').modal('hide');
							swal({
								title: "Thành Công",
								text: "Cập nhật thành công!",
								icon: "success",
							}).then(function(){
								location.href = '{{route('don-vi.index')}}';
							});
						}else if(data == 0){
							$('#Sua').modal('hide');
							swal({
								title: "Thất Bại",
								text: "Đơn Vị Đã Tồn Tại!",
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
                            $(".error").html("Vui lòng nhập tên Đơn vị.")
                        }
		});
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('don-vi.destroy',":id") }}";
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
									text: "Kiểm Tra Các Đơn Vị Có Loại Này!",
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