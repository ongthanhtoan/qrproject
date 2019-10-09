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
<body class="" data-url="http://neon.dev"> 

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
            
            @show
            {{-- main content --}}
            {{-- footer --}}
            @include('backend.layouts.codinh.footer')
            {{-- footer --}}       
        </div>

    </div>
    <!-- Imported styles on this page -->
    
    <script src="{{asset('theme/backend/assets/js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('theme/backend/assets/js/datatables/datatables.js')}}"></script>

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