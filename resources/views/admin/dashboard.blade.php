@extends('admin.layouts.app')
@section('title', 'Tổng quan hệ thống')

@section('content')
<style>
    /* Thêm hiệu ứng hover cho card bớt đơn điệu */
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary shadow-sm h-100 dashboard-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Khách hàng</h6>
                    <h2 class="mb-0">{{ $totalCustomers }}</h2>
                </div>
                <i class="fas fa-users fa-3x opacity-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0" style="background-color: rgba(0,0,0,0.1);">
                <a href="#" class="text-white stretched-link text-decoration-none small">Xem chi tiết</a>
                <div class="text-white"><i class="fas fa-arrow-circle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success shadow-sm h-100 dashboard-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Sản phẩm</h6>
                    <h2 class="mb-0">{{ $totalProducts }}</h2>
                </div>
                <i class="fas fa-boxes fa-3x opacity-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0" style="background-color: rgba(0,0,0,0.1);">
                <a href="{{ route('admin.products') }}" class="text-white stretched-link text-decoration-none small">Xem chi tiết</a>
                <div class="text-white"><i class="fas fa-arrow-circle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-dark bg-warning shadow-sm h-100 dashboard-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Đơn hàng</h6>
                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                </div>
                <i class="fas fa-shopping-bag fa-3x opacity-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0" style="background-color: rgba(0,0,0,0.05);">
                <a href="{{ route('admin.orders') }}" class="text-dark stretched-link text-decoration-none small fw-semibold">Xem chi tiết</a>
                <div class="text-dark"><i class="fas fa-arrow-circle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger shadow-sm h-100 dashboard-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Doanh thu</h6>
                    <h2 class="mb-0">{{ number_format($revenue, 0, ',', '.') }}đ</h2>
                </div>
                <i class="fas fa-wallet fa-3x opacity-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0" style="background-color: rgba(0,0,0,0.1);">
                <a href="{{ route('admin.orders') }}" class="text-white stretched-link text-decoration-none small">Xem chi tiết</a>
                <div class="text-white"><i class="fas fa-arrow-circle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-shopping-cart text-primary me-2"></i>Đơn hàng mới nhất</h6>
                <a href="{{ route('admin.orders') }}" class="text-decoration-none small text-muted">Xem tất cả</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                                <td class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                <td>
                                    @if($order->status == 'pending') 
                                        <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                    @elseif($order->status == 'completed') 
                                        <span class="badge bg-success">Hoàn thành</span>
                                    @else 
                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-light border" title="Xem chi tiết">
                                        <i class="fas fa-eye text-info"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Chưa có đơn hàng nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-box-open text-success me-2"></i>Sản phẩm mới thêm</h6>
                <a href="{{ route('admin.products') }}" class="text-decoration-none small text-muted">Xem tất cả</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($recentProducts as $product)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ Str::startsWith($product->img, ['http', '/']) ? $product->img : asset($product->img) }}" 
                                 alt="" width="45" height="45" class="rounded object-fit-cover me-3 border">
                            <div>
                                <h6 class="mb-0 text-truncate" style="max-width: 180px; font-size: 0.95rem;">{{ $product->name }}</h6>
                                <small class="text-danger fw-semibold">{{ number_format($product->price, 0, ',', '.') }}đ</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light rounded-circle border">
                            <i class="fas fa-pen text-secondary" style="font-size: 0.8rem;"></i>
                        </a>
                    </li>
                    @empty
                    <li class="list-group-item px-0 text-center text-muted py-3">Chưa có sản phẩm</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection