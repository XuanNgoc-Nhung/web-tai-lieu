<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
    <!-- Search -->
    <!-- /Search -->
    <div class="card post-widget">
        <div class="card-header">
            <h4 class="card-title">Thông báo khác</h4>
        </div>
        <div class="card-body">
            <ul class="latest-posts">
                <ul class="list-group">
                    @foreach($thong_bao_khac as $tb)
                        <li class="list-group-item"><a href="{{route('user.chiTietThongBao').'?id='.$tb->id}}">&bull; {{$tb->tieu_de}}</a></li>
                    @endforeach
                </ul>
            </ul><div class="mt-3">
                {{ $thong_bao_khac->appends(request()->query())->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
