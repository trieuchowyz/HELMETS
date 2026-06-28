@extends('layouts.main')

@section('noidungwebsite')
<!-- Single Page Header Start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Về chúng tôi</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Về chúng tôi</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Content Start -->
<div class="container py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <h2 class="text-primary mb-4">Chào mừng đến với Helmets / NVT</h2>
            <p>Chúng tôi là đơn vị chuyên cung cấp các sản phẩm mũ bảo hiểm và linh kiện đi kèm chất lượng cao. Với phương châm mang lại sự an toàn và trải nghiệm tốt nhất cho người dùng, Helmets cam kết chỉ bán hàng chính hãng, có nguồn gốc xuất xứ rõ ràng.</p>
            <p>Đội ngũ phát triển của chúng tôi bao gồm Nguyễn Văn Triều và Trương Nguyễn Đức Thịnh luôn không ngừng nỗ lực cải thiện hệ thống để mang lại sự tiện lợi nhất trong việc mua sắm của bạn.</p>
            <ul>
                <li>Cung cấp sản phẩm chính hãng 100%</li>
                <li>Dịch vụ chăm sóc khách hàng tận tâm</li>
                <li>Giao hàng nhanh chóng và an toàn trên toàn quốc</li>
            </ul>
        </div>
    </div>
</div>
<!-- Content End -->
@endsection