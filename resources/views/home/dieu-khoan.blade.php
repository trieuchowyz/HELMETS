@extends('layouts.main')

@section('noidungwebsite')
<!-- Single Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Điều khoản & Điều kiện</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Điều khoản & Điều kiện</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Content Start -->
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <h3 class="mb-4">1. Chấp thuận điều khoản</h3>
    <p>Khi truy cập và mua sắm tại trang web của chúng tôi, bạn đồng ý tuân thủ các quy định và điều kiện được nêu tại đây.</p>

    <h3 class="mt-4 mb-4">2. Quy định về tài khoản</h3>
    <p>Người dùng có trách nhiệm bảo mật thông tin tài khoản và mật khẩu của mình. Chúng tôi không chịu trách nhiệm cho những thiệt hại phát sinh từ việc bạn để lộ thông tin tài khoản.</p>

    <h3 class="mt-4 mb-4">3. Quy định về mua hàng và thanh toán</h3>
    <p>Mọi đơn hàng phải được xác nhận thanh toán hoặc áp dụng hình thức COD (thanh toán khi nhận hàng) theo đúng quy trình của website. Giá cả có thể thay đổi mà không cần báo trước, tuy nhiên giá tại thời điểm bạn đặt hàng sẽ được giữ nguyên.</p>
</div>
<!-- Content End -->
@endsection