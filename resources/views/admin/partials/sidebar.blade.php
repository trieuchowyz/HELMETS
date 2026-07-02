<div class="sidebar-backdrop" data-sidebar-close></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
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
    <a class="nav-link active" href="{{ route('admin.dashboard') }}" aria-current="page">
        <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
        <span class="nav-text">Tổng quan</span>
    </a>
    <a class="nav-link" href="{{ route('admin.thong-ke') }}">
        <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
        <span class="nav-text">Thống kê doanh thu</span>
    </a>

    <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        Kinh doanh
    </div>
    <a class="nav-link" href="{{ route('admin.quanly-donhang') }}">
        <span class="nav-icon"><i class="bi bi-bag-check" aria-hidden="true"></i></span>
        <span class="nav-text">Quản lý Đơn hàng</span>
    </a>
    <a class="nav-link" href="{{ route('admin.voucher') }}">
        <span class="nav-icon"><i class="bi bi-ticket-perforated" aria-hidden="true"></i></span>
        <span class="nav-text">Mã ưu đãi (Coupons)</span>
    </a>

    <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        Sản phẩm
    </div>
    <a class="nav-link" href="{{ route('admin.danhmuc') }}">
        <span class="nav-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
        <span class="nav-text">Quản lý Danh mục</span>
    </a>
    <a class="nav-link" href="{{ route('admin.sanpham') }}">
        <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
        <span class="nav-text">Quản lý Sản phẩm</span>
    </a>

    <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        Tài khoản
    </div>
    <a class="nav-link" href="{{ route('admin.customers') }}">
        <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
        <span class="nav-text">Khách hàng</span>
    </a>
    <a class="nav-link" href="{{ route('admin.staffs') }}">
        <span class="nav-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
        <span class="nav-text">Nhân viên</span>
    </a>

    <div class="px-4 mt-4 mb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
        Hệ thống
    </div>
    <a class="nav-link" href="{{ route('admin.profile') }}">
        <span class="nav-icon"><i class="bi bi-person-circle" aria-hidden="true"></i></span>
        <span class="nav-text">Hồ sơ cá nhân</span>
    </a>
    <a class="nav-link" href="{{ route('admin.settings') }}">
        <span class="nav-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
        <span class="nav-text">Cấu hình hệ thống</span>
    </a>

</nav>

    <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="../assets/images/avatar/avatar.jpg"
            alt="Admin Hasan">
        <strong>Admin Hasan</strong>
        <small>Active Workspace</small>
    </div>

    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
    </div>
</aside>