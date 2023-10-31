@extends("user.layouts.app")
@section("title")
    <title>Tài liệu theo môn</title>
@endsection
@section("content")
    <section class="section section-doctor" style="padding-top: 120px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6"><h2>Tài liệu cho môn học: {{$mon_hoc->ten_mon}}</h2></div>
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
                @if(isset($list_tai_lieu)&&count($list_tai_lieu))

                    @foreach($list_tai_lieu as $taiLieu)
                        <div class="col-lg-2 aos mt-3" data-aos="fade-up">
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}">
                                        <img class="img-fluid" style="width: 220px; height: 147px" alt="User Image" src="{{$taiLieu->hinh_anh?$taiLieu->hinh_anh:'assets/img/doctors/doctor-01.jpg'}}">
                                    </a>
                                    @if($taiLieu->trang_thai!=1)
                                    <div class="hetHan text-center">
                                        <h3 style="color: red; margin-top: 30%">Hết hạn</h3>
                                    </div>
                                    @endif
                                </div>
                                <div class="pro-content">
                                    <h3 class="title">
                                        <a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}">{{$taiLieu->ten_tai_lieu}}</a>
                                    </h3>
                                    <p class="speciality hien-1-dong">{{$taiLieu->mo_ta}}</p>
                                    <ul class="available-info">
{{--                                        <li class="hien-1-dong">Tác giả: </i>{{$taiLieu->tac_gia}}</li>--}}
                                        <li>Loại: {{$taiLieu->loai==1?'Đọc tại chỗ':'Mang về'}}</li>
                                        <li>Ngày tạo: {{$taiLieu->created_at}}</li>
                                        <li>
                                            Lượt xem: {{$taiLieu->luot_xem}}
                                        </li>
                                    </ul>
                                    <div class="row row-sm">
                                        <div class="col-6">

                                            @if($taiLieu->trang_thai==1)
                                                <a href="{{$taiLieu->link_file}}" class="btn view-btn">Xem/Tải</a>
                                            @else
                                                <a style="cursor: not-allowed" class="btn view-btn">Hết hạn</a>
                                            @endif
                                        </div>
                                        <div class="col-6"><a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}" class="btn book-btn">Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <h3>Môn học chưa có tài liệu</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section section-doctor pt-2" style="display: none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6"><h2>Tài liệu khác</h2></div>
{{--                <div class="col-6 text-right">--}}
{{--                    <p>Xem tất cả--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"--}}
{{--                             class="bi bi-chevron-double-right" viewBox="0 0 16 16">--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
{{--                        </svg>--}}
{{--                    </p>--}}
{{--                </div>--}}
                @foreach($list_tai_lieu_khac as $taiLieu)
                    <div class="col-lg-2 aos mt-3" data-aos="fade-up">
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="doctor-profile.html">
                                    <img class="img-fluid" alt="User Image" src="assets/img/doctors/doctor-01.jpg">
                                </a>
                                <div class="hetHan text-center">
                                    <h3 style="color: red; margin-top: 30%">Hết hạn</h3>
                                </div>
                            </div>
                            <div class="pro-content">
                                <h3 class="title">
                                    <a href="doctor-profile.html">Ruby Perrin</a>
                                    <i class="fas fa-check-circle verified"></i>
                                </h3>
                                <p class="speciality">MDS - Periodontology and Oral Implantology, BDS</p>
                                <div class="rating"><i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span class="d-inline-block average-rating">(17)</span>
                                </div>
                                <ul class="available-info">
                                    <li><i class="fas fa-map-marker-alt"></i> Florida, USA</li>
                                    <li><i class="far fa-clock"></i> Available on Fri, 22 Mar</li>
                                    <li><i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="fas fa-info-circle"
                                                                                              data-bs-toggle="tooltip"
                                                                                              title="Lorem Ipsum"></i>
                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6"><a href="doctor-profile.html" class="btn view-btn">View
                                            Profile</a>
                                    </div>
                                    <div class="col-6"><a href="booking.html" class="btn book-btn">Book Now</a>
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
