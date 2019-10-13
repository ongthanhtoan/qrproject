@extends('backend.layouts.index')
@section('title')
Bàn Giao Tài Sản
@endsection
@section('title-header')
DANH SÁCH TÀI SẢN ĐÃ BẢN GIAO
@endsection
@section('main-content')
<p align="right">
	<a class="btn btn-blue" href="{{route('ban-giao.create')}}">Thêm Mới</a>
        <button class="btn btn-danger delete-all" data-url="">Xóa</button>
</p>
<table id="myTable" class="table table-bordered datatable" style="font-size: 12px;"> 
	<thead>
		<tr>
			<th class="text-center">STT</th>
			<th class="text-center">Mã Tài Sản</th>
			<th class="text-center">Tên Tài Sản</th>
			<th class="text-center">Người Giao</th>
			<th class="text-center">Ngày Giao</th>
			<th class="text-center">Người Nhận</th>
			<th class="text-center">Ngày Nhận</th>
			<th class="text-center">Đơn Vị</th>
			<th class="text-center">Phòng</th>
			<th class="text-center">Sửa</th>
			<th class="text-center">Chọn<input type="checkbox" id="check_all"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($dsBanGiao as $stt => $bg)
		<tr id="tr_{{$bg->bg_MaBG}}">
			<td class="text-center">{{$stt+1}}</td>
			<td class="text-center">{{$bg->ts_MaTS}}</td>
			<td class="text-center">{{$bg->ts_TenTS}}</td>
			@foreach($dsCanBo as $CanBo)
			@if($bg->bg_NguoiGiao == $CanBo->cb_TenDangNhap)
			<td class="text-center">{{$CanBo->cb_HoTen}}</td>
			@endif
			@endforeach
			<td class="text-center">{{$bg->bg_NgayGiao}}</td>
			@foreach($dsCanBo as $CanBo)
			@if($bg->bg_NguoiNhan == $CanBo->cb_TenDangNhap)
			<td class="text-center">{{$CanBo->cb_HoTen}}</td>
			@endif
			@endforeach
			<td class="text-center">{{$bg->bg_NgayNhan}}</td>
			<td class="text-center">{{$bg->dv_TenDV}}</td>
			<td class="text-center">{{$bg->p_TenPhong}}</td>
			<td class="text-center">
				<a href="{{route('ban-giao.edit',['id'=>$bg->bg_MaBG])}}"><i class="entypo-pencil"></i></a>
			</td>
                        <td class="text-center">
                            <input type="checkbox" class="chon" data-id="{{$bg->bg_MaBG}}">
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
		$('#myTable').DataTable({
			pageLength: 25,
			responsive: true,
			language: {
				"sProcessing":   "Đang xử lý...",
				"sLengthMenu":   "Xem _MENU_",
				"sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
				"sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
				"sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
				"sInfoFiltered": "(được lọc từ _MAX_ mục)",
				"sInfoPostFix":  "",
				"sSearch":       "Tìm:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Đầu",
					"sPrevious": "Trước",
					"sNext":     "Tiếp",
					"sLast":     "Cuối"
				}
			},
			filterDropDown: {
				label: 'Lọc: ',                                  
				columns: [
				{ 
					idx: 1,
				},
				{ 
					idx: 3,
				},
				{ 
					idx: 5
				},
				{ 
					idx: 7
				},
				{ 
					idx: 8
				}
				],
				bootstrap: true,
				autoSize: false
			},
		});

		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('ban-giao.destroy',":id") }}";
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
                $('#check_all').on('click', function(e) {
                if($(this).is(':checked',true)){
                    $(".chon").prop('checked', true); 
                } else {  
                    $(".chon").prop('checked',false);  
                }  
            });

            $('.chon').on('click',function(){
                if($('.chon:checked').length == $('.chon').length){
                    $('#check_all').prop('checked',true);
                }else{
                    $('#check_all').prop('checked',false);
                }
            });
            $('.delete-all').on('click', function(e) {
                var idsArr = [];  
                $(".chon:checked").each(function() {  
                    idsArr.push($(this).attr('data-id'));
                });  
                if(idsArr.length <=0){  
                    swal({
                        title: "Vui lòng chọn các dòng cần xử lý!",
                        icon: "info",
                        button: "OK!",
                    });
                }else{
                    event.preventDefault();
                    swal({
                            title: "Xác nhận xóa các dòng đã chọn?",
                            text: "Nhấn OK Để Xóa, Cancel Để Hủy!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            var strIds = idsArr.join(","); 
                            $.ajax({
                            type: "POST",
                            url: "{{ route('ban-giao.multiple-delete') }}",
                            data: {
                                'ids': strIds,
                                '_token': '{{ csrf_token() }}',
                                '_method': "DELETE"
                            },
                            success: function (data) {
                                if (data['status']==true) {
                                    $(".chon:checked").each(function() {  
                                        $(this).parents("tr").remove();
                                    });
                                    swal({
                                        title: data['message'],
                                        icon: "success",
                                        button: "OK!",
                                    });
                                }
                            }
                        });
                        } else {
                            swal("Đã Hủy!", {
                                    icon: "info",
                            });
                        }
                    });
                }
            }); 
	});
</script>
@endsection