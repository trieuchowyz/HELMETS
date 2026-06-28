@extends('layouts.main')

@section('noidungwebsite')
<!-- Single Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Chính sách bảo hành</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Bảo hành</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Content Start -->
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <h3 class="mb-4">1. Điều kiện bảo hành</h3>
    <p>Sản phẩm sẽ được bảo hành miễn phí nếu đáp ứng các điều kiện sau:</p>
    <ul>
        <li>Sản phẩm còn trong thời hạn bảo hành được tính từ ngày giao hàng.</li>
        <li>Sản phẩm bị lỗi kỹ thuật do nhà sản xuất.</li>
        <li>Tem bảo hành, hóa đơn mua hàng phải còn nguyên vẹn, không có dấu hiệu chỉnh sửa, chắp vá.</li>
    </ul>

    <h3 class="mt-4 mb-4">2. Các trường hợp từ chối bảo hành</h3>
    <ul>
        <li>Sản phẩm bị hư hỏng do tác động cơ học (rơi vỡ, va đập, trầy xước) hoặc do thiên tai, hỏa hoạn.</li>
        <li>Sản phẩm có dấu hiệu tự ý tháo lắp, sửa chữa bởi cá nhân/đơn vị không thuộc ủy quyền của chúng tôi.</li>
        <li>Sử dụng sai hướng dẫn hoặc sai quy cách của nhà sản xuất.</li>
    </ul>

    <h3 class="mt-4 mb-4">3. Quy trình gửi bảo hành</h3>
    <p>Vui lòng mang hoặc gửi sản phẩm cùng hóa đơn mua hàng đến địa chỉ: <strong>123 Đường Số 1, TP. Hồ Chí Minh</strong> để được bộ phận kỹ thuật kiểm tra và xử lý.</p>
</div>
<!-- Content End -->
@endsection