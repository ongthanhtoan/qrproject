@extends('backend.layouts.index')
@section('title')
Nhật Ký Bàn Giao
@endsection
@section('title-header')
NHẬT KÝ BÀN GIAO
@endsection
@section('main-content')
<!--<p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
</p>-->
<table id="myTable" class="table table-bordered datatable" style="font-size: 12px;"> 
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Mã Tài Sản</th>
            <th class="text-center">Nội Dung</th>
            <th class="text-center">Chức Năng</th>
            <th class="text-center">Thời Gian</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
        <tr>
            <td class="text-center">{{$key+1}}</td>
            <td class="text-center">{{$value->nk_MaDanhMuc}}</td>
            <td class="text-justify">{{$value->nk_NoiDung}}</td>
            <td class="text-center">{{$value->nk_ChucNang}}</td>
            <td>{{date("d/m/Y", $value->nk_ThoiGian+36000)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('custom-script')
<script src="{{asset('vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/jquery.ui.datepicker-vi-VN.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            pageLength: 25,
            responsive: true,
            language: {
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Xem _MENU_",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix": "",
                "sSearch": "Tìm:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                    "sLast": "Cuối"
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
                    }
                ],
                bootstrap: true,
                autoSize: false
            },
        });
        var tuNgay = " Từ ngày: <input class='datepicker' data-start-view='2' type='text' id='datepicker_from'>";
        var denNgay = " Đến ngày: <input class='datepicker' data-start-view='2' type='text' id='datepicker_to'>";
        var button = '&nbsp&nbsp&nbsp<button type="button" class="btn btn-info" id="btnTim">Tìm</button>'
        $("#myTable_filterWrapper").append(tuNgay);
        $("#myTable_filterWrapper").append(denNgay);
        $("#myTable_filterWrapper").append(button);
        $("#btnTim").click(function(){
            $.ajax({
                type: 'POST',
                url: '{{route('nhat-ky.index_search')}}',
                data: {
                        'tuNgay': $("#datepicker_from").val(),
                        'denNgay': $("#datepicker_to").val(),
                        '_token': '{{csrf_token()}}'
                },
                success: function(data){
                        if(data == 1){
                            location.reload();
                        }
                }
            });
        });
//        $("#datepicker_from").datepicker({});
//        $("#datepicker_to").datepicker();
    });
    $(document).on('click', '.datepicker', function () {
        $(this).datepicker({
            closeText: "Đóng",
		prevText: "Trước",
		nextText: "Sau",
		currentText: "Hôm nay",
		monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
		monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
		dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
		dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
		dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
		weekHeader: "Tuần",
		dateFormat: "dd/mm/yy",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
        }).focus();
//        $(this).removeClass('datepicker');
    });
</script>
@endsection