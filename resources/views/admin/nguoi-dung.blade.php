@extends("admin.layout.app")
@section("title")
    <title>Người dùng</title>
@endsection
@section("content")
    <div id="app">
        <admin-quan-ly-nguoi-dung/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-quan-ly-nguoi-dung.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
