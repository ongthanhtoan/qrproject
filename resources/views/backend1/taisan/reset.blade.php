@extends('backend.layouts.index')
@section('title')
RESET 
@endsection
@section('main-content')
<form method="POST">
	<table>
		<tr>
			<th>Nhập Năm: </th>
			<td>
				<input name="txtNamTS" id="txtNamTS" type="text" class="validate" value="taisan_">
			</td>
		</tr>
		<tr>
			<th>Chọn Năm Tài Sản Kế Thừa: </th>
			<td>
				<select name="NamTS_CapNhat" id="NamTS_CapNhat">
					@foreach($table as $item)
					@if (strpos($item, 'taisan') === 0 )
					<option value="{{$item}}">{{$item}}</option>
					@endif
					@endforeach
				</select>
			</td>
		</tr>
		<tr class="text-center">
			<td>
				<button id="btnReset" type="button" class="btn waves-effect btn-primary mt-15">Thực Hiện</button>
				<a href="{{route('tai-san.index')}}" class="btn waves-effect btn-info mt-15">Bỏ Qua</a>
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