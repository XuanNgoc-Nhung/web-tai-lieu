@extends("user.layouts.app")
@section("title")
    <title>Trang chủ</title>
@endsection
@section("content")
    @include('user.layouts.search')
    <section class="section section-doctor" style="padding-top:40px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12"><h2>Thông báo </h2></div>
                <ul class="list-group">
                    @foreach($thong_bao as $tb)
                        <li class="list-group-item"><a href="{{route('user.chiTietThongBao').'?id='.$tb->id}}">&bull; [{{$tb->created_at}}] {{$tb->tieu_de}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="row" style="padding-top: 40px">
                <div class="col-12"><h2>Tài liệu được quan tâm </h2></div>
                @foreach($list_new as $post)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 aos pt-3" data-aos="fade-up">
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="{{route('user.chiTietTaiLieu').'?postId='.$post->id}}">
                                    <img class="img-fluid" alt="User Image" style="width: auto; height: 149px" src="{{$post->hinh_anh?$post->hinh_anh:'assets/img/doctors/doctor-01.jpg'}}">
                                    @if($post->trang_thai!=1)
                                        <div class="hetHan  text-center">
                                            <h3 style="color: red; margin-top: 55%">Tạm hết</h3>
                                        </div>
                                    @endif
                                </a>
{{--                                <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>--}}
{{--                                </a>--}}
                            </div>
                            <div class="pro-content">
                                <h3 class="title"><a href="{{route('user.chiTietTaiLieu').'?postId='.$post->id}}">{{$post->ten_tai_lieu}}</a></h3>
                                <p class="speciality hien-1-dong" style="min-height: 0">{{$post->mo_ta}}</p>
{{--                                <div class="rating"><i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <span class="d-inline-block average-rating">(17)</span>--}}
{{--                                </div>--}}
                                <ul class="available-info">
                                    <li><i class="fas fa-map-marker-alt"></i> {{$post->loai==1?'Đọc tại chỗ':'Mang về'}}</li>
                                    <li><i class="far fa-clock"></i> {{$post->created_at}}</li>
                                    <li><i class="far fa-eye"></i>{{$post->luot_xem}}
                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6">
                                        @if($post->trang_thai==1)
                                            <a href="{{$post->link_file}}" class="btn view-btn">Xem/Tải</a>
                                        @else
                                            <a style="cursor: not-allowed" class="btn view-btn">Tạm hết</a>
                                        @endif
                                    </div>
                                    <div class="col-6"><a href="{{route('user.chiTietTaiLieu').'?postId='.$post->id}}" class="btn book-btn">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section("js_location")
@endsection
