
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @yield('title')
    @include('admin.layout.css')

</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    @include('admin.layout.header')
    <!-- /Header -->

    <!-- Sidebar -->
    @include('admin.layout.sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid pb-0">
            @yield('content')
        </div>
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
@include('admin.layout.js')
@yield('js_location')
</body>
</html>
