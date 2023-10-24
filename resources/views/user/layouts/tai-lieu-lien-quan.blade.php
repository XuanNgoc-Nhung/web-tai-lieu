<section class="section section-doctor pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6"><h2>Tài liệu liên quan</h2></div>
            <div class="col-6 text-right">
                {{--                <p>Xem tất cả--}}
                {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"--}}
                {{--                         class="bi bi-chevron-double-right" viewBox="0 0 16 16">--}}
                {{--                        <path fill-rule="evenodd"--}}
                {{--                              d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
                {{--                        <path fill-rule="evenodd"--}}
                {{--                              d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>--}}
                {{--                    </svg>--}}
                {{--                </p>--}}
            </div>
            @foreach($tai_lieu_lien_quan as $taiLieu)
                <div class="col-lg-2 pt-4">
                    <div class="profile-widget">
                        <div class="doc-img">
                            <a href="doctor-profile.html">
                                <img class="img-fluid" style="width: 220px; height: 147px" alt="User Image"
                                     src="{{$taiLieu->hinh_anh?$taiLieu->hinh_anh:'assets/img/doctors/doctor-01.jpg'}}">
                            </a>
                            <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>
                            </a>
                        </div>
                        <div class="pro-content">
                            <h3 class="title">
                                <a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}">{{$taiLieu->ten_tai_lieu}}</a>
                            </h3>
                            <p class="speciality">{{$taiLieu->mo_ta}}</p>
                            <ul class="available-info">
                                <li><i class="fas fa-map-marker-alt"></i> {{$taiLieu->tac_gia}}</li>
                                <li><i class="far fa-clock"></i> {{$taiLieu->created_at}}</li>
                            </ul>
                            <div class="row row-sm">
                                <div class="col-6"><a href="{{$taiLieu->link_file}}" target="_blank"
                                                      class="btn view-btn">Xem/Tải</a>
                                </div>
                                <div class="col-6"><a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}"
                                                      class="btn book-btn">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
