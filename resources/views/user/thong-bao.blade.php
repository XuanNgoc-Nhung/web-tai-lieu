@extends("user.layouts.app")
@section("title")
    <title>Thông báo</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @foreach($list_thong_bao as $thong_bao)
                        <div class="card">
                            <h5 class="card-header">[Thông báo] - {{$thong_bao->created_at}}</h5>
                            <div class="card-body">
                                <h3 class="card-title"><b>{{$thong_bao->tieu_de}}</b></h3>
                                <p class="card-text">{{$thong_bao->mo_ta}}</p>
                                <a href="{{route('user.chiTietThongBao').'?id='.$thong_bao->id}}" class="btn btn-primary">Chi tiết</a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- Blog Sidebar -->
                @include('user.layouts.menu-right')
                <!-- /Blog Sidebar -->
            </div>
        </div>
    </div>
    @include('user.layouts.tai-lieu-lien-quan')
@endsection
@section("js_location")
@endsection
