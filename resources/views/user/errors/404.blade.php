
<!DOCTYPE html>
<html lang="en">
<head><base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Doccure - Error 404</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="administration/assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="administration/assets/css/bootstrap.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="administration/assets/css/feather.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="administration/assets/css/style.css">

</head>
<body class="error-page">

<!-- Main Wrapper -->
<div class="main-wrapper">

    <div class="header d-none">
        <!-- Header Menu -->
        <ul class="nav nav-tabs user-menu">
            <!-- Flag -->
            <li class="nav-item">
                <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                    <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
                </a>
            </li>
            <!-- /Flag -->
        </ul>
        <!-- Header Menu -->
    </div>

    <!-- Error 404 -->
    <div class="error-box">
        <img src="assets/img/404.png" class="img-fluid" alt="404">
        <h3>Xin lỗi! Không tìm thấy tài liệu.</h3>
            <p>Vui lòng thử lại sau hoặc liên hệ với hotline để được hỗ trợ.</p>
            <a href="{{route('user.home')}}" class="btn btn-primary"><i class="feather-home me-2"></i>Về trang chủ</a>
    </div>
    <!-- /Error 404 -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

</body>
</html>
