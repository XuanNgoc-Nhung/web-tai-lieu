<header class="header header-trans custom">
    <nav class="navbar navbar-expand-lg header-nav no-border" style="background: rgb(43, 108, 203) !important;">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
            </a>
            <a href="{{route('user.home')}}" class="navbar-brand logo">
                <img src="https://bmtu.edu.vn/images/logo.png" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{route('user.home')}}" class="menu-logo">
                    <img src="https://bmtu.edu.vn/images/logo.png" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>

            <ul class="main-nav white-font">
                @foreach($list_ctdt as $ctdt)
                    <li class="has-submenu">
                        <a href="">{{$ctdt->ten}} <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            @foreach($ctdt->monHoc as $mon)
                                <li>
                                    <a href="{{route('user.taiLieuTheoMon').'?monHocId='.$mon->id}}">{{$mon->ten_mon}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                @if (Auth::guest())
                    <li class="login-link">
                        <a href="{{route('login')}}">Đăng nhập</a>
                    </li>
                @else

                    @if(Auth::user()->role==1)
                        <li class="login-link">
                            <a href="{{route('admin.home')}}">Quản lý</a>
                        </li>
                    @endif
                    <li class="login-link">
                        <a
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                            href="{{route('login')}}">Đăng Xuất</a>
                    </li>
                @endif
            </ul>
        </div>
        <ul class="nav header-navbar-rht right-menu">

            @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link header-login white-bg" href="{{route('login')}}"><i
                            class="fas fa-user-circle me-2"></i>Đăng nhập</a>
                </li>
            @else
                @if(Auth::user()->role==1)
                    <li class="nav-item">
                        <a class="nav-link header-login white-bg" href="{{route('admin.home')}}"> Quản lý</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link header-login white-bg"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       href="{{route('login')}}"><i
                            class="fas fa-user-circle me-2"></i>Đăng xuất</a>

                </li>
            @endif
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</header>
