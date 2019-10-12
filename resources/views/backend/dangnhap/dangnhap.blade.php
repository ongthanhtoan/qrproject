<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Basic Page Needs
        ================================================== -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- For Search Engine Meta Data  -->
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="yoursite.com" />

        <title>CUSC - Đăng Nhập</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/icon" href="{{asset('theme/backend/login/images/brand-logo.png')}}" />

        <!-- Main structure css file -->
        <link rel="stylesheet" href="{{asset('theme/backend/login/css/login1-style.css')}}">

</head>

<body>
    <!-- Start Preloader -->
    <div id="preload-block">
        <div class="square-block"></div>
    </div>
    <!-- Preloader End -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                <!-- brand-logo start -->
                <div class="brand-logo text-center">
                    <img src="{{asset('theme/backend/login/images/brand-logo.png')}}" width="120" alt="brand-logo">
                </div>
                <!-- ./brand-logo -->
                <!-- authfy-login start -->
                <div class="authfy-login">
                    <!-- panel-login start -->
                    <div class="authfy-panel panel-login text-center active">
                        <div class="authfy-heading">
                            <h3 class="auth-title">CÁN BỘ ĐĂNG NHẬP</h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <form>
                                    <input type="text" class="form-control email" name="txtUser" id="txtUser">
                                    <div class="pwdMask">
                                        <input type="password" class="form-control password" name="txtPass" id="txtPass">
                                        <span class="fa fa-eye-slash pwd-toggle"></span>
                                    </div>
                                    <div class="form-group">
                                        <button id="login-user" class="btn btn-lg btn-primary btn-block" type="button">Đăng Nhập</button>
                                    </div>
                                    <p>Đăng Nhập Với Quyền Quản Trị<a class="lnk-toggler" data-panel=".panel-signup" href="#"> Đăng Nhập</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ./panel-login -->
                    <!-- panel-signup start -->
                    <div class="authfy-panel panel-signup text-center">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="authfy-heading">
                                    <h3 class="auth-title">QUẢN TRỊ ĐĂNG NHẬP</h3>
                                </div>
                                <form>
                                   <input type="text" class="form-control email" name="txtUserA" id="txtUserA">
                                   <div class="pwdMask">
                                    <input type="password" class="form-control password" name="txtPassA" id="txtPassA">
                                    <span class="fa fa-eye-slash pwd-toggle"></span>
                                </div>
                                <div class="form-group">
                                    <button id="login-admin" class="btn btn-lg btn-primary btn-block" type="button">Đăng Nhập</button>
                                </div>
                            </form>
                            <a class="lnk-toggler" data-panel=".panel-login" href="#">Đăng Nhập Người Dùng</a>
                        </div>
                    </div>
                </div>
                <!-- ./panel-signup -->
            </div>
            <!-- ./authfy-login -->
        </div>
    </div>
    <!-- ./row -->
</div>
<!-- ./container -->

<!-- Javascript Files -->

<!-- initialize jQuery Library -->
<script src="{{asset('theme/backend/login/js/jquery-2.2.4.min.js')}}"></script>

<!-- for Bootstrap js -->
<script src="{{asset('theme/backend/login/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/sweetalert.min.js')}}"></script>
<!-- Custom js-->
<script src="{{asset('theme/backend/login/js/custom.js')}}"></script>

</body>

<!-- Mirrored from gitapp.top/demo/authfy/demo/login-01.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Apr 2019 06:16:36 GMT -->
}
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login-user').click(function(event){
            if($('#txtUser').val()!="" && $('#txtPass').val()!=""){
                $.ajax({
                    type: 'POST',
                    url: '{{route('dang-nhap.postDangNhap')}}',
                    data: {
                        'txtUser': $('#txtUser').val(),
                        'txtPass': $('#txtPass').val(),
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data == 1){
                            swal({
                                title: "Đăng Nhập Thành Công!!",
                                icon: "success",
                                button: "OK!",
                            }).then(function() {
                                location.href = '{{route('home')}}';
                            });
                        }else if(data == 0){
                            swal({
                                title: "Đăng Nhập Thất Bại!",
                                text: "Kiểm Tra Lại!",
                                icon: "error",
                                button: "OK!",
                            });
                        }
                    }
                });
            }else{
                swal({
                    text: "Kiểm Tra Lại Thông Tin Đăng Nhập!",
                    icon: "error",
                    button: "OK!",
                });
            }
        });
        $('#login-admin').click(function(event){
            if($('#txtUserA').val()!="" && $('#txtPassA').val()!=""){
                $.ajax({
                    type: 'POST',
                    url: '{{route('dang-nhap.postDangNhapAdmin')}}',
                    data: {
                        'txtUserA': $('#txtUserA').val(),
                        'txtPassA': $('#txtPassA').val(),
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data == 1){
                            swal({
                                title: "Đăng Nhập Thành Công!!",
                                icon: "success",
                                button: "OK!",
                            }).then(function() {
                                location.href = '{{route('home')}}';
                            });
                        }else if(data == 0){
                            swal({
                                title: "Đăng Nhập Thất Bại!",
                                text: "Kiểm Tra Lại!",
                                icon: "error",
                                button: "OK!",
                            });
                        }
                    }
                });
            }else{
                swal({
                    text: "Kiểm Tra Lại Thông Tin Đăng Nhập!",
                    icon: "error",
                    button: "OK!",
                });
            }
        });
    });
</script>