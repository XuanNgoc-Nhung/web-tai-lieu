@extends("user.layouts.app")
@section("title")
    <title>Yêu Cầu</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @if(count($list_yeu_cau))
                        @foreach($list_yeu_cau as $yeu_cau)
                            <div class="card">
                                <h5 class="card-header">[Yêu Cầu] - {{$yeu_cau->created_at}}</h5>
                                <div class="card-body">
                                    <a href="{{route('user.chiTietYeuCau').'?id='.$yeu_cau->id}}">
                                        <h3 class="card-title"><b>{{$yeu_cau->tieu_de}}</b></h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2">
                            {{ $list_yeu_cau->links() }}
                        </div>
                    @else
                        <div class="text-center">
                            <h4>Chưa có yêu cầu</h4>
{{--                            <a href="{{route('user.home')}}" class="btn btn-primary">Về trang chủ</a>--}}
                        </div>
                    @endif
                    <div id="app">
                        <user-yeu-cau></user-yeu-cau>
                    </div>
                </div>
                @include('user.layouts.menu-right')
            </div>
        </div>
    </div>
{{--    @include('user.layouts.tai-lieu-lien-quan')--}}
@endsection
@section("js_location")
    <script src="{{asset('js/user-yeu-cau.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
