<div class="sidebar-backdrop" data-sidebar-close></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="{{ route('admin.dashboard') }}" aria-label="adminHMD dashboard">
            <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
            <span class="brand-copy">
                <span class="brand-title">HELMETS</span>
                <span class="brand-subtitle">Quản trị viên</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">

        <div class="px-4 mt-3 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Báo cáo
        </div>
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <span class="nav-text">Tổng quan</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.thong-ke') ? 'active' : '' }}" href="{{ route('admin.thong-ke') }}">
            <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
            <span class="nav-text">Thống kê doanh thu</span>
        </a>

        <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Kinh doanh
        </div>
        <a class="nav-link {{ request()->routeIs('admin.quanly-donhang*') ? 'active' : '' }}" href="{{ route('admin.quanly-donhang') }}">
            <span class="nav-icon"><i class="bi bi-bag-check" aria-hidden="true"></i></span>
            <span class="nav-text">Quản lý Đơn hàng</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.voucher*') ? 'active' : '' }}" href="{{ route('admin.voucher') }}">
            <span class="nav-icon"><i class="bi bi-ticket-perforated" aria-hidden="true"></i></span>
            <span class="nav-text">Mã ưu đãi (Coupons)</span>
        </a>

        <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Sản phẩm
        </div>
        <a class="nav-link {{ request()->routeIs('admin.danhmuc*') ? 'active' : '' }}" href="{{ route('admin.danhmuc') }}">
            <span class="nav-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
            <span class="nav-text">Quản lý Danh mục</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.sanpham*') ? 'active' : '' }}" href="{{ route('admin.sanpham') }}">
            <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
            <span class="nav-text">Quản lý Sản phẩm</span>
        </a>

        <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Tài khoản
        </div>
        <a class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}" href="{{ route('admin.customers') }}">
            <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
            <span class="nav-text">Khách hàng</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.staffs*') ? 'active' : '' }}" href="{{ route('admin.staffs') }}">
            <span class="nav-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
            <span class="nav-text">Nhân viên</span>
        </a>

        <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            Hệ thống
        </div>
        <a class="nav-link {{ request()->routeIs('admin.profile*') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
            <span class="nav-icon"><i class="bi bi-person-circle" aria-hidden="true"></i></span>
            <span class="nav-text">Hồ sơ cá nhân</span>
        </a>

    </nav>
    
    @php
    // Lấy thông tin tài khoản Admin đang hoạt động để đồng bộ ra Sidebar
    $currentAdmin = \App\Models\Staff::where('role', 'admin')->first();
    @endphp
    <div class="sidebar-user text-center mt-3 mb-3">
        <img class="avatar-img avatar-md sidebar-user-avatar mb-2"
            src="{{ $currentAdmin && $currentAdmin->avata ? asset($currentAdmin->avata) : asset('admin_assets/images/avatar/default.jpg') }}"
            alt="{{ $currentAdmin->name ?? 'Admin' }}"
            style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">

        <strong class="d-block">{{ $currentAdmin->name ?? 'Admin' }}</strong>
        <small class="text-success"><i class="bi bi-circle-fill" style="font-size: 8px;"></i> Đang hoạt động</small>
    </div>

    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">Hệ thống ổn định</span>
    </div>
</aside>