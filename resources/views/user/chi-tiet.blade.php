@extends("user.layouts.app")
@section("title")
    <title>{{$post->ten_tai_lieu}}</title>
@endsection
@section("content")
    <div class="content" style="padding-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-view">
                        <div class="blog blog-single-post">
                            <div class="blog-image">
                                <a href="">
                                    <img alt="" style="width: 200px;height: 300px" src="{{$post->hinh_anh?$post->hinh_anh:'assets/img/blog/blog-01.jpg'}}"
                                         class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{$post->ten_tai_lieu}}</h3>

                            <div class="blog-info clearfix">
                                <a href="{{$post->link_file}}" class="btn btn-outline-success book-btn">Xem ngay/Tải xuống</a>
                            </div>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                Tác giả:
                                                    <span>{{$post->tac_gia}}</span>
                                            </div>
                                        </li>
                                        <li>Ngày đăng: {{$post->created_at}}</li>
                                        <li>Lượt xem: {{$post->luot_xem}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <p>{!!$post->noi_dung!!}</p>
                            </div>
                        </div>
                        <div class="card blog-share clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Tags</h4>
                            </div>
                            <div class="card-body">
                                <ul class="tags">
                                    @foreach(explode(',', $post->tag) as $tag)
                                        <li><a href="#" class="tag">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
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
