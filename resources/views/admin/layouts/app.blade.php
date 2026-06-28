<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản trị - Shop Nón')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --admin-theme: #e27c00; }
        body { background-color: #f4f6f9; overflow-x: hidden; }
        
        /* Cấu hình Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            transition: all 0.3s ease;
        }
        .sidebar .brand { background-color: #212529; padding: 20px; text-align: center; color: white; font-weight: bold;}
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 15px 20px; display: block; border-left: 3px solid transparent; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: #fff; border-left-color: var(--admin-theme); }
        .sidebar i { width: 25px; text-align: center; } /* Căn giữa các icon */
        
        /* Cấu hình vùng nội dung */
        .content-area { width: 100%; transition: all 0.3s ease; }
        .top-navbar { background: #fff; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,.04); display: flex; justify-content: space-between; align-items: center; }
        
        /* Responsive & Toggle Action */
        .sidebar.toggled { margin-left: -250px; }
        @media (min-width: 768px) {
            .sidebar { width: 250px; position: fixed; z-index: 1000; }
            .content-area { margin-left: 250px; width: calc(100% - 250px); }
            .sidebar.toggled { margin-left: -250px; }
            .content-area.toggled { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        
        <div class="sidebar" id="sidebar">
            <div class="brand">
                <i class="fas fa-helmet-safety me-2 text-warning"></i> ADMIN HELMETS
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Tổng quan
                </a>
                <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <i class="fas fa-motorcycle"></i> Quản lý Mũ/Nón
                </a>
                <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> Đơn hàng
                </a>
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Xem trang chủ
                </a>
            </div>
        </div>

        <div class="content-area" id="page-content-wrapper">
            
            <div class="top-navbar mb-4">
                <button class="btn btn-light" id="menu-toggle"><i class="fas fa-bars"></i></button>
                
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-dark dropdown-toggle fw-bold" data-bs-toggle="dropdown">
                        <i class="fas fa-user-shield text-primary me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item" href="{{ route('home.index') }}">Quay về Website</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>

            <div class="container-fluid px-4 pb-5">
                <h4 class="mb-4 text-uppercase fw-bold text-secondary">@yield('title', 'Bảng điều khiển')</h4>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert" id="success-alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('assets_admin/js/main.js') }}"></script>
</body>
</html>