<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @yield('title')
    @include('user.layouts.style')
</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper multi-optn">
    <!-- Header -->
    @include('user.layouts.header')
    <!-- /Header -->
    @include('user.layouts.home-banner')
    <div>
        @yield('content')
    </div>
    <!-- Footer -->
    @include('user.layouts.footer')
    <!-- /Footer -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
@include('user.layouts.js')
</body>
</html>
