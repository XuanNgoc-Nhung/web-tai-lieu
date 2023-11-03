@extends("user.layouts.app")
@section("title")
    <title>{{$thong_bao->tieu_de}}</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card text-center">
                        <div class="card-header">
                            Thông báo
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><b>{{$thong_bao->tieu_de}}</b></h3>
                            <div>{!! $thong_bao->noi_dung !!}</div>
                            <a href="{{route('user.thongBao')}}" class="btn btn-primary">Quay lại</a>
                        </div>
                        <div class="card-footer text-muted">
                           Đã gửi: {{$thong_bao->created_at}}
                        </div>
                    </div>
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
