<header class="header header-trans custom" >
    <nav class="navbar navbar-expand-lg header-nav no-border" style="background: rgb(43, 108, 203) !important;">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
            </a>
            <a href="index.html" class="navbar-brand logo">
                <img src="assets/img/footer-logo.png" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="index.html" class="menu-logo">
                    <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
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
                                <li><a href="doctor-dashboard.html">{{$mon->ten_mon}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li class="login-link">
                    <a href="login.html">Login / Signup</a>
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht right-menu">
            <li class="nav-item">
                <a class="nav-link header-login white-bg" href="login.html"><i class="fas fa-user-circle me-2"></i>Đăng ký</a>
            </li>
        </ul>
    </nav>
</header>
