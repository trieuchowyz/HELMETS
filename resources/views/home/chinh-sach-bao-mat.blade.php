@extends('layouts.main')

@section('noidungwebsite')
<!-- Single Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Chính sách bảo mật</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Chính sách bảo mật</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Content Start -->
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <h3 class="mb-4">1. Thu thập thông tin cá nhân</h3>
    <p>Chúng tôi thu thập thông tin cá nhân của bạn khi bạn đăng ký tài khoản, đặt hàng hoặc liên hệ với chúng tôi (Bao gồm Tên, Email, Số điện thoại, Địa chỉ).</p>
    
    <h3 class="mt-4 mb-4">2. Sử dụng thông tin</h3>
    <p>Thông tin của bạn sẽ được sử dụng để:</p>
    <ul>
        <li>Xử lý và giao đơn hàng cho bạn.</li>
        <li>Hỗ trợ khách hàng và giải quyết khiếu nại.</li>
        <li>Gửi các thông báo về đơn hàng hoặc khuyến mãi (nếu bạn đăng ký nhận bản tin).</li>
    </ul>

    <h3 class="mt-4 mb-4">3. Cam kết bảo mật</h3>
    <p>Chúng tôi cam kết không mua bán, trao đổi hay chia sẻ thông tin cá nhân của bạn cho bất kỳ bên thứ ba nào khác nhằm mục đích thương mại.</p>
</div>
<!-- Content End -->
@endsection