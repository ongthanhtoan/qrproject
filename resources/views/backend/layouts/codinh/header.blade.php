<div class="row">
    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">

            <li class="sep"></li>


            <li>
                @if(Session::has('user'))
                <p>{{Session::get('user')['name']}}</p>
                @elseif(Session::has('admin'))
                <p>{{Session::get('admin')}}</p>
                @endif
            </li>

            <li class="sep"></li>

            <li>
                <a href="{{route('dang-xuat')}}">
                    Đăng Xuất <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div> 
</div>
@if(!isset($home))
<div style="/*background-color: #0072bc;*/ height: 40px; ">
    <h3 class="text-left font-size-30" style="margin: 0px; /*color:white;*/ line-height: 40px;">@yield('title-header')</h3>
</div>
@endif
<hr style="margin-top:5px;" />