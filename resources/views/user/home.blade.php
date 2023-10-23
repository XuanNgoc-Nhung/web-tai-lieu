@extends("user.layouts.app")
@section("title")
    <title>Trang chủ</title>
@endsection
@section("content")
    @include('user.layouts.search')
    <section class="section section-doctor" style="padding-top:40px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6"><h2>Tài liệu được quan tâm</h2></div>
                <div class="col-6 text-right">
{{--                    <p>Xem tất cả--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"--}}
{{--                             class="bi bi-chevron-double-right" viewBox="0 0 16 16">--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
{{--                        </svg>--}}
{{--                    </p>--}}
                </div>
                @foreach($list_new as $post)
                    <div class="col-lg-2 aos pt-3" data-aos="fade-up">
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="{{route('user.chiTietTaiLieu').'?post='.$post->id}}">
                                    <img class="img-fluid" alt="User Image" style="width: 223px; height: 149px" src="{{$post->hinh_anh?$post->hinh_anh:'assets/img/doctors/doctor-01.jpg'}}">
                                </a>
                                <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>
                                </a>
                            </div>
                            <div class="pro-content">
                                <h3 class="title"><a href="doctor-profile.html">{{$post->ten_tai_lieu}}</a></h3>
                                <p class="speciality" style="min-height: 0">{{$post->mo_ta}}</p>
{{--                                <div class="rating"><i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <i class="fas fa-star filled"></i>--}}
{{--                                    <span class="d-inline-block average-rating">(17)</span>--}}
{{--                                </div>--}}
                                <ul class="available-info">
                                    <li><i class="fas fa-map-marker-alt"></i> {{$post->tac_gia}}</li>
                                    <li><i class="far fa-clock"></i> {{$post->created_at}}</li>
                                    <li><i class="far fa-eye"></i>{{$post->luot_xem}}
                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6"><a href="doctor-profile.html" class="btn view-btn">Chi tiết</a>
                                    </div>
                                    <div class="col-6"><a href="booking.html" class="btn book-btn">Xem/tải</a>
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
