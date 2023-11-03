@extends("admin.layout.app")
@section("title")
    <title>Thông báo</title>
@endsection
@section("content")
    <div id="app">
        <admin-quan-ly-thong-bao/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-quan-ly-thong-bao.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
