@extends('layouts.main')

@section('noidungwebsite')
<!-- Single Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Liên hệ</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Liên hệ</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Content Start -->
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="mb-4">Thông tin liên hệ</h2>
            <p class="mb-4">Nếu bạn có bất kỳ thắc mắc nào về sản phẩm hay dịch vụ, vui lòng liên hệ với chúng tôi qua các thông tin dưới đây.</p>
            <div class="d-flex mb-4">
                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                <div>
                    <h4>Địa chỉ</h4>
                    <p class="mb-0">123 Đường Số 1, TP. Hồ Chí Minh, Việt Nam</p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                <div>
                    <h4>Email</h4>
                    <p class="mb-0">helmet@gmail.com</p>
                </div>
            </div>
            <div class="d-flex mb-4">
                <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                <div>
                    <h4>Điện thoại</h4>
                    <p class="mb-0">(+84) 912 234 567</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
            <h2 class="mb-4">Gửi tin nhắn cho chúng tôi</h2>
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control py-3" placeholder="Họ và tên của bạn">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control py-3" placeholder="Email của bạn">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control py-3" placeholder="Tiêu đề">
                    </div>
                    <div class="col-12">
                        <textarea class="form-control py-3" rows="5" placeholder="Nội dung tin nhắn"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Gửi Tin Nhắn</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Content End -->
@endsection