    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('theme/backend/login/images/brand-logo.png')}}" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon">
                        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li>
                    <a href="{{route('home')}}">
                        <i class="entypo-chart-bar"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('tai-san.index')}}">
                        <i class="entypo-briefcase"></i>
                        <span class="title">Tài Sản</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('ban-giao.index')}}">
                        <i class="entypo-retweet"></i>
                        <span class="title">Bàn Giao Tài Sản</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('loai.index')}}">
                        <i class="entypo-suitcase"></i>
                        <span class="title">Loại Tài Sản</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('phong.index')}}">
                        <i class="entypo-monitor"></i>
                        <span class="title">Phòng Ban</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('hien-trang.index')}}">
                        <i class="entypo-battery"></i>
                        <span class="title">Hiện Trạng</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('don-vi.index')}}">
                        <i class="entypo-vcard"></i>
                        <span class="title">Đơn Vị</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="entypo-user"></i>
                        <span class="title">Tài Khoản Quản Trị</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('can-bo.index')}}">
                        <i class="entypo-users"></i>
                        <span class="title">Tài Khoản Cán Bộ</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('reset.getReset')}}">
                        <i class="entypo-database"></i>
                        <span class="title">Khởi tạo dữ liệu</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>