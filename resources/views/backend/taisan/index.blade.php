@extends('backend.layouts.index')
@section('title')
Tài Sản
@endsection
@section('title-header')
DANH SÁCH TÀI SẢN
@endsection
@section('main-content')
@section('custom-css')
<style>
    table{
        margin: 0 auto;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed; 
        word-wrap:break-word;
    }
	/*#myTable_filterWrapper{
		width: 200px;
	}*/
	#myTable_info{
		display: none;
	}
	.anchu{ max-width: 100px; min-width: 70px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
</style>
@endsection
<p align="right">
	<a href="{{route('tai-san.create')}}" class="btn btn-blue">Thêm</a>
	<button type="button" class="btn btn-blue" data-toggle="modal" data-target="#myModal">Thêm từ file</button>
	<a href="{{route('export.getExport')}}" class="btn btn-blue">Xuất excel</a>
</p>
@if(Session::has('message'))
@foreach(Session::get('message') as $value)
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ $value }}</p>
@endforeach
@endif
<table id="myTable" class="table table-bordered datatable" style="font-size: 10px;"> 
	<thead> 
		<tr >
			<th class="text-center font-size-10">STT</th>
			<th class="text-center font-size-10">Mã Tài Sản</th>
			<th class="text-center font-size-10">Tên Tài Sản</th>
			<th class="text-center font-size-10">Loại Tài Sản</th>
			<th class="text-center font-size-10">Hiện Trạng</th>
			<th class="text-center font-size-10">Số Lượng</th>
			<th class="text-center font-size-10">Năm</th>
			<th class="text-center font-size-10">Ngày Kiểm Kê</th>
			<th class="text-center font-size-10">Người Kiểm Kê</th>
			<th class="text-center font-size-10">Kiểm Kê</th>
			<th class="text-center font-size-10">Hiệu Lực</th>
			<th class="text-center font-size-10">Sửa</th>
			<th class="text-center font-size-10">Chọn</th>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsachtaisan as $stt => $taisan)
		<tr >
                    <td class="text-center font-size-10"><a href="#" data-id="{{$taisan->ts_MaTS}}" class="get_info"><b>{{$stt+1}}</b></a></td>
			<td class="text-center font-size-10 anchu">{{$taisan->ts_MaTS}}</td>
			<td class="text-center font-size-10 anchu">{{$taisan->ts_TenTS}}</td>
			<td class="text-center font-size-10 anchu">{{$taisan->l_TenLoai}}</td>
			<td class="text-center font-size-10 anchu">{{$taisan->ht_TenHT}}</td>
			<td class="text-center font-size-10">{{$taisan->ts_SoLuong}}</td>
			<td class="text-center font-size-10">{{$taisan->ts_Nam}}</td>
			<td class="text-center font-size-10">{{$taisan->ts_NgayKiemKe}}</td>
			<td class="text-center font-size-10 anchu">{{$taisan->cb_HoTen}}</td>
			<td class="text-center font-size-10">
				@if($taisan->ts_KiemKe==1)
				Đã kiểm kê
                                @else
                                Chưa kiểm kê
				@endif
			</td>
			<td class="text-center font-size-10">
				@if($taisan->ts_HieuLuc==1)
				Đã bàn giao
                                @else
                                Chưa kiểm kê
				@endif
			</td>
			<td class="text-center">
				<a href="{{route('tai-san.edit',['id'=>$taisan->ts_MaTS])}}"><i class="entypo-pencil" style="font-size: 15px;"></i></a>
				<!-- <button data-id="{{$taisan->ts_MaTS}}" class="text-center font-size-10 btn waves-effect m-2 btn-outline-danger btnXoa">Xóa</button> -->
				
			</td>
			<td>
				<button data-id="{{$taisan->ts_MaTS}}" type="button" class="btn btn-red btnXoa">
					Xóa<i class="entypo-cancel"></i>
				</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
    <!--model chi tiet tai san-->
    <div class="modal fade" id="ChiTiet_TS">
        <div class="modal-dialog">
            <div class="modal-content" style="font-size:15px;">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thông Tin Chi Tiết Tài Sản</h4>
			</div>

                <div class="modal-body" style="width: 100">
				<p class="error" style="color:red;"></p>
				<div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Mã tài sản:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='Ma_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Tên tài sản:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='Ten_TS' style='word-wrap: break-word'> </p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Loại tài sản:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='Loai_TS' style='word-wrap: break-word;'> </p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Nguyên giá:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='NguyenGia_TS' style='word-wrap: break-word;'> </p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Số lượng:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='SoLuong_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4">

						<div class="form-group" style='text-align: right'>
                                                    <p><b>Hiện trạng:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='HienTrang_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4" style='text-align: right'>

						<div class="form-group">
                                                    <p><b>Năm mua:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='NamMua_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4" style='text-align: right'>

						<div class="form-group">
                                                    <p><b>Ngày kiểm kê:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='NgayKiemKe_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4" style='text-align: right'>

						<div class="form-group">
                                                    <p><b>Người kiểm kê:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='NguoiKiemKe_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4" style='text-align: right'>
                                            
						<div class="form-group">
                                                    <p><b>Nâng cấp:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">
                                            
						<div class="form-group">
                                                    <p id='NangCap_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>
                                <div class="row">
					<div class="col-md-4" style='text-align: right'>

						<div class="form-group">
                                                    <p><b>Kiểm kê:</b></p>
						</div>	

					</div>
                                    <div class="col-md-8">

						<div class="form-group">
                                                    <p id='KiemKe_TS' style='word-wrap: break-word;'></p>
						</div>	

					</div>

				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-red" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
    <!-- end model chi tiet tai san-->
</div>
@endsection
@section('custom-script')
<script>
	$(document).ready(function(){
            $(".get_info").click(function(){
                var ID = $(this).data('id');
                var URL = "{{ route('tai-san.show',":id") }}";
                URL = URL.replace(':id', ID);
                $.ajax({
                        type: "GET",
                        url: URL,
                        success: function(data){
                            $("#Ma_TS").html(data[0]['ts_MaTS']);
                            $("#Ten_TS").html(data[0]['ts_TenTS']);
                             $("#Loai_TS").html(data[0]['l_TenLoai']);
                             $("#NguyenGia_TS").html(data[0]['ts_NguyenGia']);
                             $("#SoLuong_TS").html(data[0]['ts_SoLuong']);
                             $("#HienTrang_TS").html(data[0]['ht_TenHT']);
                             $("#NamMua_TS").html(data[0]['ts_Nam']);
                             $("#NgayKiemKe_TS").html(data[0]['ts_NgayKiemKe']);
                             $("#NguoiKiemKe_TS").html(data[0]['cb_HoTen']);
                             $("#NangCap_TS").html(data[0]['ts_NangCap']);
                             var kiemKe ='';
                             if(data[0]['ts_KiemKe'] == 1){
                                 kiemKe = "Đã kiểm kê";
                             }else{
                                 kiemKe = "Chưa kiểm kê";
                             }
                             $("#KiemKe_TS").html(kiemKe);
//                             console.log(data);
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
                $('#ChiTiet_TS').modal().show();
            });
		$('#myTable').DataTable({
                        columnDefs: [
                            { width: 18, targets: 0 },
                            { width: 20, targets: 1 },
                            { width: 50, targets: 4 },
                            { width: 33, targets: 5 },
                            { width: 35, targets: 6 },
                            { width: 35, targets: 7 },
                            { width: 50, targets: 9 },
                            { width: 50, targets: 10 },
                            { width: 20, targets: 11 },
                            { width: 40, targets: 12 },
                        ],
			pageLength: 25,
			responsive: true,
			language: {
				"sProcessing":   "Đang xử lý...",
				"sLengthMenu":   "Hiển thị _MENU_ dòng",
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
					idx: 3,
				},
				{ 
					idx: 4
				},
				{ 
					idx: 8
				},
				{ 
					idx: 9
				},
				{ 
					idx: 10
				}
				],
				bootstrap: true,
				autoSize: false
			},
		});
		$('.btnXoa').click(function(event){
			var ID = $(this).data('id');
			var URL = "{{ route('tai-san.destroy',":id") }}";
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
<script>
    $('#modal').click(function(){
                    $(".error").html('');
			$('#ChiTiet_TS').modal().show();
		});
</script>
@endsection