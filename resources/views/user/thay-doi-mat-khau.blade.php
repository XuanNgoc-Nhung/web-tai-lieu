@extends("user.layouts.app")
@section("title")
    <title>Thay đổi mật khẩu</title>
@endsection
@section("content")
    <div class="content ">
        <div class="container-fluid"  id="app">
            <user-doi-mat-khau/>
        </div>

    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/user-doi-mat-khau.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
