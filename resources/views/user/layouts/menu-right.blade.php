<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
    <!-- Search -->
    <div class="card search-widget">
        <div class="card-body">
            <form action="{{route('user.timKiemTaiLieu')}}" class="search-form">
                <div class="input-group">
                    <input type="text" value="{{ app('request')->input('key') }}" name="key" placeholder="Nhập từ khóa" class="form-control">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Search -->
    <div class="card post-widget">
        <div class="card-header">
            <h4 class="card-title">Tài liệu mới</h4>
        </div>
        <div class="card-body">
            <ul class="latest-posts">
                @foreach($tai_lieu_moi as $tl)
                    <li style="display: inline">
                        <div class="post-thumb" style="margin-top: 10px">
                            <a href="{{route('user.chiTietTaiLieu').'?postId='.$tl->id}}">
                                <img class="img-fluid" style="width: 70px; height: 90px" src="{{$tl->hinh_anh?$tl->hinh_anh:'assets/img/blog/blog-thumb-01.jpg'}}" alt="">
                            </a>
                        </div>
                        <div class="post-info" style="margin-left:inherit ; display: none">
                            <h4>
                                <a href="{{route('user.chiTietTaiLieu').'?postId='.$tl->id}}">{{$tl->ten_tai_lieu}}</a>
                            </h4>
{{--                            <p>{{$tl->created_at}}</p>--}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
