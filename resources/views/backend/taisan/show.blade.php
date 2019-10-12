<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="{{asset('theme/backend/login/images/brand-logo.png')}}">

	<title>Admin CUSC @yield('title')</title>

	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/font-icons/entypo/css/entypo.css')}}">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/neon-core.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/neon-theme.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/neon-forms.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/rickshaw/rickshaw.min.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/datatables/datatables.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/select2/select2-bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/select2/select2.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/selectboxit/jquery.selectBoxIt.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/daterangepicker/daterangepicker-bs3.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/icheck/skins/minimal/_all.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/icheck/skins/square/_all.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/icheck/skins/flat/_all.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/icheck/skins/futurico/futurico.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/icheck/skins/polaris/polaris.css')}}">
	<link rel="stylesheet" href="{{asset('theme/backend/assets/css/custom.css')}}">

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @section('custom-css')
    @show
</head>
{{-- page-body  page-fade class hiệu ứng load trang --}}
<body class="" data-url="http://neon.dev" style="background-color: #FFF"> 
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		{{-- main content --}}
		<div class="main-content">
			{{-- topsidebar --}}
			@include('backend.layouts.codinh.header')
			{{-- end topsidebar --}}
			@section('main-content')
			<div class="flash-message">
				@foreach (['danger','success'] as $msg)
				@if(Session::has('alert-' . $msg))
				<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
				@endif
				@endforeach
			</div>
			<h3 style="color: black; font-weight: bold;" class="text-center text-uppercase">Thông tin tài sản </h3>
                        <div class="row"></div>
                        
                        
			<table class="table table-bordered responsive" style="font-size: 20px; width: 75%;" align="center">
				<thead>
					<tr>
						<th style="color: black; font-weight: bold; text-align: right;">Mã tài sản:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_MaTS}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: right;">Tên tài sản: </th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_TenTS}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: right;">Loại Tài Sản:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->l_TenLoai}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align:right;">Nguyên Giá:</th>
						<td style="color: black; font-weight: bold;">{{number_format($danhsachtaisan[0]->ts_NguyenGia),0,'.'}} VNĐ</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: right;">Số Lượng:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_SoLuong}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Hiện Trạng:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ht_TenHT}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Năm Mua:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_Nam}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Ngày Kiểm Kê:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_NgayKiemKe}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Người Kiểm Kê:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->cb_HoTen}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Nâng Cấp:</th>
						<td style="color: black; font-weight: bold;">{{$danhsachtaisan[0]->ts_NangCap}}</td>
					</tr>
					<tr>
						<th style="color: black; font-weight: bold; text-align: left;">Kiểm Kê:</th>
						<td>
							@if($danhsachtaisan[0]->ts_KiemKe==0)
							<span class="badge badge-pill m-2 badge-danger">Chưa Kiểm Kê</span>
							@else
							<span class="badge badge-pill m-2 badge-success">Đã Kiểm Kê</span>
							@endif
						</td>
					</tr>
				</thead>
			</table>
			<div class="text-center">
				@if($danhsachtaisan[0]->ts_KiemKe==0)
				<a class="btn waves-effect m-2 btn-round btn-success btn-lg" href="{{route('kiem-ke.kiemKe',['id'=>$danhsachtaisan[0]->ts_MaTS])}}">Kiểm Kê</a>
				@else
				<a class="btn waves-effect m-2 btn-round btn-danger btn-lg" href="{{route('kiem-ke.huyKiemKe',['id'=>$danhsachtaisan[0]->ts_MaTS])}}">Bỏ Kiểm Kê</a>
				@endif
			</div>
			@show
			{{-- main content --}}
			{{-- footer --}}
			@include('backend.layouts.codinh.footer')
			{{-- footer --}}       
		</div>

	</div>
	<!-- Imported styles on this page -->
	
	<script src="{{asset('theme/backend/assets/js/jquery-1.11.3.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('theme/backend/assets/js/select2/select2.css')}}">
	<script src="{{asset('theme/backend/assets/js/datatables/datatables.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/select2/select2.min.js')}}"></script>

	<!-- Bottom scripts (common) -->
	
	<script src="{{asset('theme/backend/assets/js/gsap/TweenMax.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/bootstrap.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/joinable.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/resizeable.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/neon-api.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>


	<!-- Imported scripts on this page -->
	<script src="{{asset('theme/backend/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/rickshaw/vendor/d3.v3.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/rickshaw/rickshaw.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/raphael-min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/morris.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/toastr.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/neon-chat.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/jquery.validate.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/select2/select2.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/bootstrap-tagsinput.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/typeahead.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/selectboxit/jquery.selectBoxIt.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/moment.min.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/jquery.multi-select.js')}}"></script>
	<script src="{{asset('theme/backend/assets/js/icheck/icheck.min.js')}}"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{asset('theme/backend/assets/js/neon-custom.js')}}"></script>
	<script src="{{asset('vendor/sweetalert.min.js')}}"></script>
	<script src="{{asset('vendor/filterDropDown.min.js')}}"></script>
	{{-- <script src="{{asset('vendor/jquery.datetimepicker.full.js')}}"></script> --}}

	<!-- Demo Settings -->
	{{-- <script src="{{asset('theme/backend/assets/js/neon-demo.js')}}"></script> --}}
	@section('custom-script')
	@show
</body>
</html>