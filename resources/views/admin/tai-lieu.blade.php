@extends("admin.layout.app")
@section("title")
    <title>Tài liệu</title>
@endsection
@section("content")
    <div id="app">
        <admin-quan-ly-tai-lieu/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-quan-ly-tai-lieu.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
