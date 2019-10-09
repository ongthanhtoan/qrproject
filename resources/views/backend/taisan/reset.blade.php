@extends('backend.layouts.index')
@section('title')
RESET 
@endsection
@section('title-header')
KHỞI TẠO DỮ LIỆU
@endsection
@section('main-content')
<form method="POST">
	<table align="center">
		<tr>
			<th>Nhập Năm: </th>
			<td>
			<div class="form-group">
				<input name="txtNamTS" id="txtNamTS"  class="form-control" type="text" class="validate" value="taisan_">
			</div>
			</td>
		</tr>
		<tr>
			<th>Chọn Năm Tài Sản Kế Thừa: </th>
			<td>
				<select name="NamTS_CapNhat" id="NamTS_CapNhat"  class="form-control">
					@foreach($table as $item)
					@if (strpos($item, 'taisan') === 0 )
					<option value="{{$item}}">{{$item}}</option>
					@endif
					@endforeach
				</select>
			</td>
		</tr>
		<tr class="text-center">
			<td align="right">
			<br>
				<button id="btnReset" type="button" class="btn btn-blue">Thực Hiện</button>
			</td>
			<td align="left">
			<br>
			&ensp;<a href="{{route('tai-san.index')}}" class="btn btn-danger">Bỏ Qua</a>
			</td>
		</tr>
		
	</table>
	
</form>
@endsection
@section('custom-script')
<script>
	$('#btnReset').click(function(){
		$.ajax({
			type: 'POST',
			url: '{{route('reset.postReset')}}',
			data: {
				'txtNamTS': $('#txtNamTS').val(),
				'NamTS_CapNhat': $('#NamTS_CapNhat').val(),
				'_token': '{{csrf_token()}}'
			},
			success: function(data){
				if(data == 1){
					swal({
						title: "Đã Tạo Mới Thành Công!",
						icon: "success",
						button: "OK!",
					}).then(function() {
						location.href = '{{route('tai-san.index')}}';
					});
				}else if(data == 0){
					swal({
						title: "Thất Bại!",
						text: "Kiểm Tra Và Thử Lại Sau!",
						icon: "error",
						button: "OK!",
					});
				}
			}
		});
	});
</script>
@endsection