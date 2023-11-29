@extends("user.layouts.app")
@section("title")
    <title>{{$yeu_cau->tieu_de}}</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h5 class="card-title"><span style="color:slategray">[{{$yeu_cau->created_at}}]</span><br><b>{{$yeu_cau->tieu_de}} </b></h5>
                        </div>
                        <div class="card-body" style="text-align: left">
                            <div>{!! $yeu_cau->noi_dung !!}</div>
                        </div>
                        <div class="text-center">
                            <a href="{{route('user.yeuCau')}}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                </div>
                <!-- Blog Sidebar -->
                @include('user.layouts.menu-right-yeu-cau')
                <!-- /Blog Sidebar -->
            </div>
        </div>
    </div>
    {{--    @include('user.layouts.tai-lieu-lien-quan')--}}
@endsection
@section("js_location")
@endsection
