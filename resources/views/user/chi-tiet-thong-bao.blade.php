@extends("user.layouts.app")
@section("title")
    <title>{{$thong_bao->tieu_de}}</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h5 class="card-title"><span style="color:slategray">[{{$thong_bao->created_at}}]</span><br><b>{{$thong_bao->tieu_de}} </b></h5>
                        </div>
                        <div class="card-body" style="text-align: left">
                            <div>{!! $thong_bao->noi_dung !!}</div>
                        </div>
                    </div>
                    <div class="text-center" style="padding: 20px">
                        <a href="{{route('user.thongBao')}}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
                <!-- Blog Sidebar -->
                @include('user.layouts.menu-right-thong-bao')
                <!-- /Blog Sidebar -->
            </div>
        </div>
    </div>
    {{--    @include('user.layouts.tai-lieu-lien-quan')--}}
@endsection
@section("js_location")
@endsection
