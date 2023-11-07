@extends("admin.layout.app")
@section("title")
    <title>Học phần</title>
@endsection
@section("content")
    <div id="app">
        <admin-quan-ly-mon-hoc/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-quan-ly-mon-hoc.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
