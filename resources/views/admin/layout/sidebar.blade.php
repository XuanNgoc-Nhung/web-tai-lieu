<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Hệ thống</span></li>

{{--                <li class=" {{ Request::routeIs('admin.home')? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.home')}}"><i class="feather-grid"></i> <span>Tổng quan</span></a>--}}
{{--                </li>--}}
                <li class=" {{ Request::routeIs('admin.home')? 'active' : '' }}">
                    <a href="{{route('admin.home')}}"><i class="feather-sliders"></i> <span>Chương trình đào tạo</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.monHoc')? 'active' : '' }}">
                    <a href="{{route('admin.monHoc')}}"><i class="feather-sliders"></i> <span>Học phần</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.taiLieu')? 'active' : '' }}">
                    <a href="{{route('admin.taiLieu')}}"><i class="feather-sliders"></i> <span>Tài liệu</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.thongBao')? 'active' : '' }}">
                    <a href="{{route('admin.thongBao')}}"><i class="feather-sliders"></i> <span>Thông báo</span></a>
                </li>
                <li>
                    <a href="/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                            class="feather-log-out me-1"></i> <span>Đăng xuất</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
