@extends("admin.layout.app")
@section("title")
    <title>Yêu Cầu</title>
@endsection
@section("content")
    <div id="app">
        <admin-quan-ly-yeu-cau/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-quan-ly-yeu-cau.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
