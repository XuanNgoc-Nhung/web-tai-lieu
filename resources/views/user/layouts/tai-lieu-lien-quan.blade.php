<section class="section section-doctor pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 titleCustom"><h2>Tài liệu liên quan</h2></div>
            @foreach($tai_lieu_lien_quan as $taiLieu)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pt-4">
                    <div class="profile-widget">
                        <div class="doc-img">
                            <a href="doctor-profile.html">
                                <img class="img-fluid" style="width: auto; height: 147px" alt="User Image"
                                     src="{{$taiLieu->hinh_anh?$taiLieu->hinh_anh:'assets/img/doctors/doctor-01.jpg'}}">

                                @if($taiLieu->trang_thai!=1)
                                    <div class="hetHan text-center">
                                        <h3 style="color: red; margin-top: 55%">Tạm hết</h3>
                                    </div>
                                @endif
                            </a>

                        </div>
                        <div class="pro-content">
                            <h3 class="title">
                                <a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}">{{$taiLieu->ten_tai_lieu}}</a>
                            </h3>
                            <p class="speciality hien-1-dong">{{$taiLieu->mo_ta}}</p>
                            <ul class="available-info">
                                <li><i class="fas fa-map-marker-alt"></i> {{$taiLieu->loai==1?'Đọc tại chỗ':'Mang về'}}
                                </li>
                                <li><i class="far fa-clock"></i> {{$taiLieu->created_at}}</li>
                            </ul>
                            <div class="row row-sm">
                                <div class="col-6">
                                    @if($taiLieu->trang_thai==1)
                                        <a href="{{$taiLieu->link_file}}" target="_blank"
                                           class="btn view-btn">Xem/Tải</a>
                                    @else
                                        <a style="cursor: not-allowed" class="btn view-btn">Tạm hết</a>
                                    @endif
                                </div>
                                <div class="col-6"><a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}"
                                                      class="btn book-btn">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-2">
                {{ $tai_lieu_lien_quan->links() }}
            </div>
        </div>
    </div>
</section>
