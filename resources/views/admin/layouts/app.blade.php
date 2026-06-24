<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - Shop Nón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #212529; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: #e27c00; color: white; } /* Đổi màu cam cho hợp theme */
        .content-area { padding: 20px; background-color: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-2 sidebar">
                <h4 class="text-white text-center py-4 border-bottom border-secondary">ADMIN SHOP NÓN</h4>
                <div class="mt-3">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Tổng quan
                    </a>
                    <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        <i class="fas fa-motorcycle me-2"></i> Quản lý Mũ/Nón
                    </a>
                    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart me-2"></i> Đơn hàng
                    </a>
                    <a href="{{ url('/') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i> Xem trang chủ
                    </a>
                </div>
            </div>

            <div class="col-md-10 content-area">
                <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm mb-4">
                    <h5 class="mb-0 text-uppercase fw-bold">@yield('title', 'Bảng điều khiển')</h5>
                    <div>
                        <span class="me-3 fw-bold text-primary"><i class="fas fa-user-shield me-1"></i> {{ Auth::user()->name ?? 'Admin' }}</span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>