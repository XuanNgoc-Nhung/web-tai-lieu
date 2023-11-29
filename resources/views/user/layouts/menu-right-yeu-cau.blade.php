<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
    <!-- Search -->
    <!-- /Search -->
    <div class="card post-widget">
        <div class="card-header">
            <h4 class="card-title">Yêu cầu khác</h4>
        </div>
        <div class="card-body">
            <ul class="latest-posts">
                <ul class="list-group">
                    @foreach($yeu_cau_khac as $tb)
                        <li class="list-group-item"><a href="{{route('user.chiTietYeuCau').'?id='.$tb->id}}">&bull; {{$tb->tieu_de}}</a></li>
                    @endforeach
                </ul>
            </ul><div class="mt-3">
                {{ $yeu_cau_khac->appends(request()->query())->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
