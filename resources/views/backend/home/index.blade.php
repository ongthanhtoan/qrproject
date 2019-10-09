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
    <link rel="stylesheet" href="{{asset('theme/backend/assets/css/custom.css')}}">

    <script src="{{asset('theme/backend/assets/js/jquery-1.11.3.min.js')}}"></script>

    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @section('custom-css')
    @show
</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        {{-- sidebar --}}
        @include('backend.layouts.codinh.sidebar')
        {{-- end sidebar --}}

        {{-- main content --}}
        <div class="main-content">
            {{-- topsidebar --}}
            @include('backend.layouts.codinh.header')
            {{-- end topsidebar --}}
            @section('main-content')
            <div class="row">
                <div class="col-sm-12 col-xs-12" style="background-color:#EAF0F1;">

                    <span style="text-align:center;color:#74B9FF;
                    text-shadow: 4px 1px 2px grey;
                    font-weight: bold;"><h2><b>TRUNG TÂM CÔNG NGHỆ PHẦN MỀM ĐẠI HỌC CẦN THƠ</b></h2></span>
                    <span style="text-align:center;color:#8e44ad;
                    text-shadow: 4px 1px 2px grey;
                    font-weight: bold;"><h1><b>HỆ THỐNG QUẢN LÝ, KIỂM KÊ TÀI SẢN</b></h1></span>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <a href="{{route('don-vi.index')}}">
                        <div class="tile-stats tile-red">
                            <div class="icon"><i class="entypo-chart-bar"></i></div>
                            <div class="num" id="sl_DonVi"></div>

                            <h3>Số Đơn Vị Hiện Có</h3>

                        </div>
                    </a>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="{{route('tai-san.index')}}">
                        <div class="tile-stats tile-green">
                            <div class="icon"><i class="entypo-chart-bar"></i></div>
                            <div class="num" id="sl_TaiSan"></div>

                            <h3>Số Tài Sản Hiện Có</h3>

                        </div>
                    </a>
                </div>

                <div class="clear visible-xs"></div>

                <div class="col-sm-3 col-xs-6">
                    <a href="{{route('loai.index')}}">
                        <div class="tile-stats tile-aqua">
                           <div class="icon"><i class="entypo-chart-bar"></i></div>
                           <div class="num"  id="sl_Loai"></div>

                           <h3>Loại Tài Sản Hiện Có</h3>

                       </div>
                   </a>
               </div>

               <div class="col-sm-3 col-xs-6">
                <a href="{{route('phong.index')}}">
                    <div class="tile-stats tile-blue">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" id="sl_Phong"></div>

                        <h3>Phòng Ban Hiện Có</h3>

                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <a href="{{route('users.index')}}">
                    <div class="tile-stats tile-cyan">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" id="sl_QuanTri"></div>

                        <h3>Số Quản Trị Hiện Có</h3>

                    </div>
                </a>
            </div>
            
            <div class="col-sm-3">
                <a href="{{route('can-bo.index')}}">
                    <div class="tile-stats tile-purple">
                        <div class="icon"><i class="entypo-users"></i>></div>
                        <div class="num" id="sl_CanBo"></div>

                        <h3>Số Cán Bộ Hiện Có</h3>

                    </div>
                </a>
            </div>
            
            <div class="col-sm-3">
                <a href="{{route('hien-trang.index')}}">
                    <div class="tile-stats tile-pink">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" id="sl_HienTrang"></div>

                        <h3>Hiện Trạng Hiện Có</h3>

                    </div>
                </a>
            </div>
            
            <div class="col-sm-3">
                <a href="{{route('ban-giao.index')}}">
                    <div class="tile-stats tile-orange">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" id="sl_BanGiao"></div>

                        <h3>Số Tài Sản Bàn Giao</h3>
                    </div>
                </a>
            </div>
        </div>
        @show
        {{-- main content --}}
        {{-- footer --}}
        @include('backend.layouts.codinh.footer')
        {{-- footer --}}       
    </div>

</div>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('theme/backend/assets/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
<link rel="stylesheet" href="{{asset('theme/backend/assets/js/rickshaw/rickshaw.min.css')}}">

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


<!-- JavaScripts initializations and stuff -->
<script src="{{asset('theme/backend/assets/js/neon-custom.js')}}"></script>


<!-- Demo Settings -->
<script src="{{asset('theme/backend/assets/js/neon-demo.js')}}"></script>
{{-- nhúng angularJS --}}
<script src="{{asset('angularJS/angular.min.js')}}"></script>
<script src="{{asset('app/app.js')}}"></script>
@section('custom-script')
@show
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: '{{route('Count-Tai-San')}}',
            dataType: "text",
            success: function(data){
                $("#sl_TaiSan").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Loai')}}',
            dataType: "text",
            success: function(data){
                $("#sl_Loai").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Don-Vi')}}',
            dataType: "text",
            success: function(data){
                $("#sl_DonVi").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Hien-Trang')}}',
            dataType: "text",
            success: function(data){
                $("#sl_HienTrang").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Phong')}}',
            dataType: "text",
            success: function(data){
                $("#sl_Phong").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-User')}}',
            dataType: "text",
            success: function(data){
                $("#sl_QuanTri").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Can-Bo')}}',
            dataType: "text",
            success: function(data){
                $("#sl_CanBo").html(data);
            }
        });
        $.ajax({
            type: "GET",
            url: '{{route('Count-Ban-Giao')}}',
            dataType: "text",
            success: function(data){
                $("#sl_BanGiao").html(data);
            }
        });
    });
</script>
</body>
</html>