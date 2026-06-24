@extends('admin.layouts.app')
@section('title', 'Tổng quan hệ thống')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Khách hàng</h6>
                    <h2 class="mb-0">{{ $totalCustomers }}</h2>
                </div>
                <i class="fas fa-users fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Linh kiện PC</h6>
                    <h2 class="mb-0">{{ $totalProducts }}</h2>
                </div>
                <i class="fas fa-boxes fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Đơn hàng</h6>
                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                </div>
                <i class="fas fa-shopping-bag fa-3x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2">Doanh thu</h6>
                    <h2 class="mb-0">{{ number_format($revenue, 0, ',', '.') }}đ</h2>
                </div>
                <i class="fas fa-wallet fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
</div>
@endsection