<section class="news-letter-five" style="padding-top: 110px;padding-bottom: 15px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="news-five"
                     style="background:url('https://png.pngtree.com/thumb_back/fw800/background/20230702/pngtree-educational-materials-3d-render-for-back-to-school-image_3728180.jpg')">
                    <div class="news-five-head aos" data-aos="fade-up">
                        <h2>Tìm kiếm tài liệu</h2>
                        <p style="color:blue">Tìm kiếm tài liệu phù hợp và tốt nhất cho bạn.</p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="news-five-form aos" data-aos="fade-up">
                                <form action="{{route('user.timKiemTaiLieu')}}">
                                    <div class="form-group mb-0">
                                        <input type="text" name="key" class="form-control" placeholder="Nhập từ khóa">
                                        <button type="submit" class="btn">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
