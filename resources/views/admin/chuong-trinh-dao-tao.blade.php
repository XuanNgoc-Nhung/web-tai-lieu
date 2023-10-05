@extends("admin.layout.app")
@section("title")
    <title>Chương trình đào tạo</title>
@endsection
@section("content")
    <div id="app">
        <admin-chuong-trinh-dao-tao/>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-chuong-trinh-dao-tao.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
