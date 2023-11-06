@extends("user.layouts.app")
@section("title")
    <title>Tài liệu theo môn</title>
@endsection
@section("content")
    <section class="section section-doctor" style="padding-top: 120px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12"><h2>Tài liệu cho môn học: {{$mon_hoc->ten_mon}}</h2></div>
                @if(isset($list_tai_lieu)&&count($list_tai_lieu))
                    @foreach($list_tai_lieu as $taiLieu)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 aos mt-3" data-aos="fade-up">
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}">
                                        <img class="img-fluid" style="width: 120px; height: 150px" alt="User Image"
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
                                                <a style="cursor: not-allowed" class="btn view-btn">Tạm hết</a>
                                            @endif
                                        </div>
                                        <div class="col-6"><a
                                                href="{{route('user.chiTietTaiLieu').'?postId='.$taiLieu->id}}"
                                                class="btn book-btn">Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-2">
                        {{ $list_tai_lieu->appends(request()->query())->onEachSide(1)->links() }}
                    </div>
                @else
                    <div class="text-center">
                        <h3>Môn học chưa có tài liệu</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section("js_location")
@endsection
