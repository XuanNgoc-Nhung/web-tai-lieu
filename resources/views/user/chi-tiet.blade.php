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
                                    <img alt="" src="{{$post->hinh_anh?$post->hinh_anh:'assets/img/blog/blog-01.jpg'}}"
                                         class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{$post->ten_tai_lieu}}</h3>

                            <div class="blog-info clearfix">
                                <a href="" class="btn btn-primary">Xem</a>
                                <a href="" class="btn btn-primary">Tải xuống</a>
                            </div>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="doctor-profile.html"><img
                                                        src="assets/img/doctors/doctor-thumb-02.jpg" alt="Post Author">
                                                    <span>{{$post->tac_gia}}</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-calendar"></i>{{$post->created_at}}</li>
                                        <li><i class="far fa-comments"></i>{{$post->luot_xem}}</li>
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
